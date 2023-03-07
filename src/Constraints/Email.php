<?php

namespace App\Constraints;

use Symfony\Component\Validator\Constraints\Email as SymfonyConstraintsEmail;

class Email extends SymfonyConstraintsEmail
{
    public $message = 'Неверный Email';
}
