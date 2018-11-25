<?php

namespace Sayla\Helper\Data;

class ArrayObject extends BaseCollectionable
{
    public function __construct(array $data = [])
    {
        $this->setArrayData($data);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if ($offset === null) {
            $this->push($value);
        } else {
            $this->put($offset, $value);
        }
    }

    public function push($value)
    {
        $this->items[] = $value;
    }

    public function put($key, $value)
    {
        $this->items[$key] = $value;
    }
}
