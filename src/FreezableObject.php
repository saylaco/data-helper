<?php

namespace Sayla\Helper\Data;

use Sayla\Helper\Data\Contract\FreezableTrait;

class FreezableObject extends StandardObject implements Contract\Freezable
{
    use FreezableTrait;
}