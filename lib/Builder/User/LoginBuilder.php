<?php

namespace RunetId\ApiClient\Builder\User;

use RunetId\ApiClient\Builder\AbstractEndpointBuilder;
use RunetId\ApiClient\Builder\ModelResultTrait;
use RunetId\ApiClient\Model\User\User;

/**
 * @method $this setEmail(string $email)
 * @method $this setPassword(string $password)
 * @method $this setDeviceType(string $deviceType) iOS|Android
 * @method $this setDeviceToken(string $deviceToken)
 *
 * @method User getResult()
 */
class LoginBuilder extends AbstractEndpointBuilder
{
    use ModelResultTrait;

    /**
     * @var array
     */
    public $context = [
        'endpoint' => '/user/login',
        'method' => 'POST',
    ];

    /**
     * {@inheritdoc}
     */
    protected function getResultClass()
    {
        return 'RunetId\ApiClient\Model\User\User';
    }
}