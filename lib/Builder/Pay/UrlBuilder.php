<?php

namespace RunetId\ApiClient\Builder\Pay;

use RunetId\ApiClient\Builder\AbstractBuilder;
use RunetId\ApiClient\ArgumentHelper\ArgumentHelper;
use RunetId\ApiClient\ArgumentHelper\UserRunetIdInterface;

/**
 * @method \RunetId\ApiClient\Result\Pay\UrlResult getResult()
 */
class UrlBuilder extends AbstractBuilder
{
    /**
     * @var array
     */
    public $context = [
        'class' => 'RunetId\ApiClient\Result\Pay\UrlResult',
        'endpoint' => '/pay/url',
        'method' => 'GET',
    ];

    /**
     * @param int|UserRunetIdInterface $payerRunetId
     *
     * @return $this
     */
    public function setPayerRunetId($payerRunetId)
    {
        return $this->setParam('PayerRunetId', ArgumentHelper::getUserRunetId($payerRunetId));
    }
}