<?php

namespace App\Constraints;

use Symfony\Component\Validator\Constraints\Collection as SymfonyConstraintCollection;

class Collection extends SymfonyConstraintCollection
{
    public $missingFieldsMessage = 'Поле не заполнено';
}