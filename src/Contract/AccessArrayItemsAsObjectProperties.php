<?php

namespace Sayla\Helper\Data\Contract;
/**
 * Trait AccessArrayItemsAsObjectProperties
 * @mixin \ArrayAccess
 */
trait AccessArrayItemsAsObjectProperties
{
    /**
     * Whether a offset exists
     */
    public function __isset($offset)
    {
        return $this->offsetExists($offset);
    }

    /**
     * Offset to retrieve
     */
    public function __get($offset)
    {
        return $this->offsetGet($offset);
    }

    /**
     * Offset to set
     */
    public function __set($offset, $value)
    {
        $this->offsetSet($offset, $value);
    }

    /**
     * Offset to unset
     */
    public function __unset($offset)
    {
        $this->offsetUnset($offset);
    }
}