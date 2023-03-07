<?php

namespace App\Factory;

use App\DTO\CreateChatDTO;
use App\Entity\Chat;

class ChatFactory
{
    public static function create(CreateChatDTO $dto)
    {
        $chat = new Chat();
        $chat->setIssue($dto->issue);
        return $chat;
    }
}
