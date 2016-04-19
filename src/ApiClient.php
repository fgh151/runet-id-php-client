<?php

namespace RunetId\ApiClient;

use RunetId\ApiClient\Exception\InvalidArgumentException;
use RunetId\ApiClient\Facade\EventFacade;
use RunetId\ApiClient\Facade\ProfInterestFacade;
use RunetId\ApiClient\Facade\UserFacade;
use Ruvents\HttpClient\HttpClient;
use Ruvents\HttpClient\Request\Uri;
use Ruvents\HttpClient\Response\Response;

/**
 * Class ApiClient
 * @package RunetId\ApiClient
 */
class ApiClient
{
    /**
     * @var array
     */
    protected $options = [
        'secure' => false,
        'host' => 'api.runet-id.com',
        'model_reconstructor' => [],
    ];

    /**
     * @var ModelReconstructor
     */
    protected $modelReconstructor;

    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = array_replace_recursive($this->options, $options);

        if (empty($this->options['key']) || empty($this->options['secret'])) {
            throw new InvalidArgumentException('Key and secret options must be provided.');
        }

        $this->modelReconstructor = new ModelReconstructor($this->options['model_reconstructor']);
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param string $path
     * @param array  $data
     * @param array  $headers
     * @return Response
     */
    public function get($path, array $data = [], array $headers = [])
    {
        $this->prepareQuery($data);
        $uri = Uri::createHttp($this->options['host'], $path, [], $this->options['secure']);

        return HttpClient::get($uri, $data, $headers);
    }

    /**
     * @param string $path
     * @param array  $query
     * @param mixed  $data
     * @param array  $headers
     * @param array  $files
     * @return Response
     */
    public function post($path, array $query = [], $data = null, array $headers = [], array $files = [])
    {
        $this->prepareQuery($query);
        $uri = Uri::createHttp($this->options['host'], $path, $query, $this->options['secure']);

        return HttpClient::post($uri, $data, $headers, $files);
    }

    /**
     * @param int|null $runetId
     * @return UserFacade
     */
    public function user($runetId = null)
    {
        return new UserFacade($this, $this->modelReconstructor, $runetId);
    }

    /**
     * @return EventFacade
     */
    public function event()
    {
        return new EventFacade($this, $this->modelReconstructor);
    }

    /**
     * @return ProfInterestFacade
     */
    public function profInterest()
    {
        return new ProfInterestFacade($this, $this->modelReconstructor);
    }

    /**
     * @param array $query
     */
    protected function prepareQuery(array &$query)
    {
        $timestamp = time();
        $hash = $this->generateHash($this->options['key'], $this->options['secret'], $timestamp);

        $query = array_merge([
            'ApiKey' => $this->options['key'],
            'Timestamp' => $timestamp,
            'Hash' => $hash,
        ], $query);
    }

    /**
     * @param string $key
     * @param string $secret
     * @param int    $timestamp
     * @return string
     */
    private function generateHash($key, $secret, $timestamp)
    {
        return substr(md5($key.$timestamp.$secret), 0, 16);
    }
}