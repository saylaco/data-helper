<?php

namespace Sayla\Helper\Data;

abstract class ArrayAccessibleObject extends StandardObject implements \ArrayAccess
{
    /**
     * Whether a offset exists
     */
    final public function offsetExists($offset)
    {
        return $this->isPropertyValueSet($offset);
    }

    /**
     * Offset to retrieve
     */
    final public function offsetGet($offset)
    {
        return $this->getPropertyValue($offset);
    }

    /**
     * Offset to set
     */
    final public function offsetSet($offset, $value)
    {
        $this->setPropertyValue($offset, $value);
    }

    /**
     * Offset to unset
     */
    final public function offsetUnset($offset)
    {
        $this->unsetPropertyValue($offset);
    }
}