<?php

namespace App\Constraints;

use Symfony\Component\Validator\Constraints\Choice as SymfonyConstraintsChoice;

class Choice extends SymfonyConstraintsChoice
{
    public $message = 'Выбирите значение';
}
