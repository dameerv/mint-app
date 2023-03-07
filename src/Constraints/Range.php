<?php

namespace App\Constraints;

use Symfony\Component\Validator\Constraints\Range as SymfonyConstraintRange;

class Range extends SymfonyConstraintRange
{
    public $notInRangeMessage = 'Значение должно быть между {{ min }} и {{ max }}';
    public $minMessage = 'Минимальное означение дожно быть равным {{ limit }}';
    public $maxMessage = 'Маскимальное значение должно быть равным{ limit }}';
    public $invalidMessage = 'Значение должно быть числом';
}
