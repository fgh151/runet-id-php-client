<?php

namespace RunetId\Client\Endpoint;

use Http\Discovery\StreamFactoryDiscovery;
use Psr\Http\Message\RequestInterface;

final class FormUrlencodedBodyHelper
{
    private $data = [];

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function addData(array $data)
    {
        $this->data = array_merge($this->data, $data);

        return $this;
    }

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
    public function setValue($name, $value)
    {
        $this->data[$name] = $value;

        return $this;
    }

    /**
     * @param RequestInterface $request
     *
     * @return RequestInterface
     */
    public function apply(RequestInterface $request)
    {
        $body = StreamFactoryDiscovery::find()->createStream(http_build_query($this->data, null, '&'));

        return $request
            ->withBody($body)
            ->withHeader('Content-Type', 'application/x-www-form-urlencoded');
    }
}