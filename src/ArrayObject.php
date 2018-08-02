<?php

namespace Sayla\Helper\Data;

class ArrayObject extends BaseArrayObject
{
    public function __construct(array $data = [])
    {
        $this->setArrayData($data);
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
