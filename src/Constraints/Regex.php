<?php

namespace App\Constraints;

use Symfony\Component\Validator\Constraints\Regex as SymfonyConstraintRegex;

class Regex extends SymfonyConstraintRegex
{
    public const NAME_PATTERN = '/^[A-ЯЁа-яё\-\s]+$/';
    public const PASSPORT_PATTERN = '/^[0-9]{4} [0-9]{6}$/';
    public const DATE_PATTERN = '/^[0-3]?[0-9].[0-3]?[0-9].(?:[0-9]{2})?[0-9]{2}$/';
    public const UNIT_CODE_PATTERN = '/^[0-9]{3}-[0-9]{3}$/';
    public const INN_PATTERN = '/^[0-9]{12}$/';
    public const PHONE_PATTERN = '/^[0-9]{11,17}$/';

    public $message;
    public $pattern;

    public function __construct($options = null)
    {
        if (is_string($options) && preg_match('/^\/.+\//', $options)) {
            $this->pattern = $options;
        } elseif (isset($options['pattern'])) {
            $this->pattern = $options['pattern'];
        }

        $this->initMessage();
        parent::__construct($options);
    }

    private function initMessage()
    {
        switch ($this->pattern) {
            case self::NAME_PATTERN:
                $this->message = 'Должно быть только одно слово';
                break;

            case self::PASSPORT_PATTERN:
                $this->message = 'Неккоректный формат серии и номера паспорта';
                break;

            case self::DATE_PATTERN:
                $this->message = 'Не верно указана дата';
                break;

            case  self::UNIT_CODE_PATTERN:
                $this->message = 'Код подразделения указан неверно';
                break;

            case self::INN_PATTERN:
                $this->message = 'Неверный формат INN';
                break;

            case self::PHONE_PATTERN:
                $this->message = 'Неверный формат номера телефона';
                break;

            default:
                $this->message = 'Неверный формат';
        }
    }
}
