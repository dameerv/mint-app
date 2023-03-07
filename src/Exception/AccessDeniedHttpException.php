<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException as KernelAccessDeniedHttpException;

class AccessDeniedHttpException extends KernelAccessDeniedHttpException
{
}
