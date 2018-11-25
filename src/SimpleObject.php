<?php

namespace Sayla\Helper\Data;

class SimpleObject implements \ArrayAccess
{
    use Contract\AccessObjectPropertiesAsArrayItems;

    /**
     * SimpleObject constructor.
     */
    public function __construct(iterable $values)
    {
        foreach ($values as $k => $v)
            $this[$k] = $v;
    }
}