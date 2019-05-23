<?php

namespace Sayla\Helper\Data;
/**
 * @method push($item)
 * @method put($key, $item)
 */
abstract class BaseArrayObject implements Contract\ArrayObject
{
    protected $items = [];

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

    protected function &getArrayData()
    {
        return $this->items;
    }

    public function jsonSerialize()
    {
        $dataArray = [];
        foreach ($this->getArrayCopy() as $k => $v) {
            if ($v instanceof \JsonSerializable) {
                $dataArray[$k] = $v->jsonSerialize();
            } elseif ($v instanceof Arrayable) {
                $dataArray[$k] = $v->toArray();
            } else {
                $dataArray[$k] = $v;
            }
        }
        return $dataArray;
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->items);
    }

    abstract public function offsetSet($offset, $value);

    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    protected function setArrayData(array $data)
    {
        $this->items = $data;
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

    /**
     * Convert the object to its JSON representation.
     *
     * @param int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->items, $options);
    }
}
