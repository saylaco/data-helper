<?php

namespace Sayla\Helper\Data\Contract;

trait DecoratesAccessibleArray
{
    /**
     * Whether a offset exists
     */
    public function offsetExists($offset)
    {
        return $this->getDecoratedArray()->offsetExists($offset);
    }

    protected abstract function getDecoratedArray(): \ArrayAccess;

    /**
     * Offset to retrieve
     */
    public function offsetGet($offset)
    {
        return $this->getDecoratedArray()->offsetGet($offset);
    }

    /**
     * Offset to set
     */
    public function offsetSet($offset, $value)
    {
        return $this->getDecoratedArray()->offsetSet($offset, $value);
    }

    /**
     * Offset to unset
     */
    public function offsetUnset($offset)
    {
        return $this->getDecoratedArray()->offsetUnset($offset, $value);
    }
}