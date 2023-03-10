<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Request\Request;
use Symfony\Component\Validator\Constraint;

interface ApiActionInterface
{
    public function getConstraints(): ?Constraint;

    public function execute(array $data, Request $request, array $context = []): ?array;
}
