<?php

namespace RunetId\ApiClient\Denormalizer\Pay;

use RunetId\ApiClient\Denormalizer\ModelDenormalizer;
use RunetId\ApiClient\Model\Pay\Order;

class OrderAwareItemDenormalizer extends ModelDenormalizer
{
    /**
     * {@inheritdoc}
     */
    protected function instantiateObject(&$data, $class, $format = null, array &$context)
    {
        $order = isset($context[self::PARENT_OBJECT]) && $context[self::PARENT_OBJECT] instanceof Order
            ? $context[self::PARENT_OBJECT]
            : null;

        return new $class($order);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $class, $format = null, array $context = [])
    {
        return 'RunetId\ApiClient\Model\Pay\Item' === $class || is_subclass_of($class, 'RunetId\ApiClient\Model\Pay\Item');
    }
}
