<?php

namespace Sayla\Helper\Data;
/**
 * @method put($key, $item)
 * @method get($key)
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

    final public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            throw new \UnexpectedValueException($offset . ' is not defined');
        }
        return $this->get($offset);
    }

    final public function offsetSet($offset, $value)
    {
        $this->put($offset, $value);
    }

}
