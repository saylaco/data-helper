<?php

namespace Sayla\Helper\Data;
/**
 * @method push($item)
 * @method put($key, $item)
 */
abstract class BaseArrayObject implements Contract\ArrayObject
{
    protected $allowUndefinedKeys = true;
    protected $items = [];

    public function offsetSet($offset, $value)
    {
        if ($offset === null) {
            if (!$this->allowUndefinedKeys ) {
                throw new \UnexpectedValueException($offset . ' is not defined');
            }
            $this->push($value);
        } else {
            $this->put($offset, $value);
        }
    }

    public function count()
    {
        return count($this->items);
    }

    /**
     * @return array
     */
    public function getArrayCopy(): array
    {
        return $this->items;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->items;
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->items);
    }

    public function offsetGet($offset)
    {
        if (!$this->allowUndefinedKeys && !$this->offsetExists($offset)) {
            throw new \UnexpectedValueException($offset . ' is not defined');
        }
        return $this->items[$offset];
    }

    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->items, $options);
    }

    protected function &getArrayData()
    {
        return $this->items;
    }

    protected function setArrayData(array $data)
    {
        $this->items = $data;
    }
}
