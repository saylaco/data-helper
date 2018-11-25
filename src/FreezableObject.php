<?php

namespace Sayla\Helper\Data;

use Sayla\Helper\Data\Contract\FreezableTrait;

class FreezableObject extends SimpleObject implements Contract\Freezable
{
    use FreezableTrait;
}