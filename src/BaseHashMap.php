<?php

namespace Sayla\Helper\Data;
/**
 * @method put($key, $item)
 */
abstract class BaseHashMap extends BaseCollectionable
{
    protected function fill($array)
    {
        foreach ($array as $k => $v) {
            $this->put($k, $v);
        }
        return $this;
    }

    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            throw new \UnexpectedValueException($offset . ' is not defined');
        }
        return $this->items[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->put($offset, $value);
    }

}
