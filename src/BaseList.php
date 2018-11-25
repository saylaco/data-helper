<?php

namespace Sayla\Helper\Data;
/**
 * @method push($item)
 */
abstract class BaseList extends BaseCollectionable
{
    protected function fill($array)
    {
        foreach ($array as $v) {
            $this->push($v);
        }
        return $this;
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->push($value);
    }
}
