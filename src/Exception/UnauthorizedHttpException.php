<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException as KernelUnauthorizedHttpException;

class UnauthorizedHttpException extends KernelUnauthorizedHttpException
{
}
