<?php

namespace App\Exception;

use Exception;
use Throwable;

class OnlyAdminRoleAcceptableException extends Exception
{
    protected $message = 'Ответственным может быть только пользователь с ролью админимтратора.';

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if(!$message){
            $message = $this->message;
        }
        parent::__construct($message, $code, $previous);
    }
}
