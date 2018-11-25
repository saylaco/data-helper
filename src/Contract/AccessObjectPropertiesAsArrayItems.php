<?php

namespace Sayla\Helper\Data\Contract;

trait AccessObjectPropertiesAsArrayItems
{
    /**
     * Whether a offset exists
     */
    public function offsetExists($offset)
    {
        return isset($this->{$offset});
    }

    /**
     * Offset to retrieve
     */
    public function offsetGet($offset)
    {
        return $this->{$offset};
    }

    /**
     * Offset to set
     */
    public function offsetSet($offset, $value)
    {
        $this->{$offset} = $value;
    }

    /**
     * Offset to unset
     */
    public function offsetUnset($offset)
    {
        unset($this->{$offset});
    }
}