<?php

namespace App\Constraints;

use Symfony\Component\Validator\Constraints\IsTrue as SymfonyConstraintsIsTrue;

class IsTrue extends SymfonyConstraintsIsTrue
{
    public $message = 'Значение должно быть истинным';
}
