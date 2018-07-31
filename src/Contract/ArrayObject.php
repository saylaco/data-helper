<?php

namespace Sayla\Helper\Data\Contract;

interface ArrayObject extends \ArrayAccess, \IteratorAggregate, \JsonSerializable, \Countable
{

    /**
     * @return array
     */
    public function getArrayCopy(): array;

}