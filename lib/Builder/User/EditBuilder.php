<?php

namespace RunetId\ApiClient\Builder\User;

use RunetId\ApiClient\Builder\AbstractEndpointBuilder;
use RunetId\ApiClient\Builder\ModelResultTrait;
use RunetId\ApiClient\Model\User\User;

/**
 * @method $this setEmail(string $email)
 * @method $this setFirstName(string $firstName)
 * @method $this setLastName(string $lastName)
 * @method $this setFatherName(string $fatherName)
 * @method $this setPhoto(string $photo)
 * @method $this setPrimaryPhone(string $primaryPhone)
 * @method $this setAttributes(string $attributes)
 *
 * @method User getResult()
 */
class EditBuilder extends AbstractEndpointBuilder
{
    use ModelResultTrait;

    /**
     * @var array
     */
    public $context = [
        'endpoint' => '/user/edit',
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