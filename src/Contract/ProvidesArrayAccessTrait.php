<?php

namespace Sayla\Helper\Data\Contract;
/**
 * Trait ProvidesArrayAccessTrait
 * @package Sayla\Helper\Data\Contract
 * @deprecated use DecoratesAccessibleArray
 */
trait ProvidesArrayAccessTrait
{
    use DecoratesAccessibleArray;

    public function getIterator()
    {
        return new \ArrayIterator($this->getDecoratedArray());
    }
}