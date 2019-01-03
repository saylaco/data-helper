<?php

namespace Sayla\Helper\Data\Contract;

trait ProvidesArrayAccessTrait
{
    private static $arrayablePropertyName = 'items';
    /**
     * Offset to retrieve
     */
    public function offsetGet($offset)
    {
        return $this->{self::$arrayablePropertyName}[$offset];
    }

    /**
     * Offset to set
     */
    public function offsetSet($offset, $value)
    {
        $this->{self::$arrayablePropertyName}[$offset] = $value;
    } /**
     * Offset to set
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->{self::$arrayablePropertyName});
    }

}