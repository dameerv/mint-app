<?php

namespace App\Exception;

use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Throwable;

class CsrfTokenExpiredException extends InvalidCsrfTokenException
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        if ($message === '') {
            $message = 'Токен устарел!';
        }

        parent::__construct($message, $code, $previous);
    }
}
