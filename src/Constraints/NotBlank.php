<?php

namespace App\Constraints;

use Symfony\Component\Validator\Constraints\NotBlank as SymfonyConstraintNotBlank;

class NotBlank extends SymfonyConstraintNotBlank
{
    public $message = 'Обязательное поле';
}
