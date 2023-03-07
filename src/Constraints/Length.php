<?php

namespace App\Constraints;

use Symfony\Component\Validator\Constraints\Length as SymfonyConstraintsLength;

class Length extends SymfonyConstraintsLength
{
    public $minMessage = 'Длина должна быть не менее {{ limit }} знаков';
    public $maxMessage = "Длина должна быть не более {{ limit }} знаков";
}
