<?php

namespace Sayla\Helper\Data\Contract;

interface Collectionable extends \ArrayAccess, \IteratorAggregate, \JsonSerializable, \Countable
{

    /**
     * @return array
     */
    public function getArrayCopy(): array;

}