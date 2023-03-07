<?php

namespace App\Factory;

use App\DTO\CreateIssueDTO;
use App\Entity\Issue;

class IssueFactory
{
    public static function create(CreateIssueDTO $dto): Issue
    {
        return new Issue($dto->title, $dto->description);
    }
}
