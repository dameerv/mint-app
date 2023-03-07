<?php

namespace App\Constraints;

use Symfony\Component\Validator\Constraints\Type as SymfonyConstraintType;

class Type extends SymfonyConstraintType
{
    public $message = 'Тип данных поля должен быть {{ type }}';
}
