<?php

namespace App\Constraints;

use Symfony\Component\Validator\Constraints\NotNull as SymfonyConstrainsNotNull;

class NotNull extends SymfonyConstrainsNotNull
{
    public $message = 'Обязательное поле';
}
