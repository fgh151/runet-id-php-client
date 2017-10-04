<?php

namespace RunetId\ApiClient\Result\User;

use Ruvents\AbstractApiClient\Result\AbstractResult;

/**
 * @property string $Small
 * @property string $Medium
 * @property string $Large
 * @property string $Original
 */
class PhotoResult extends AbstractResult
{
    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->Original;
    }
}