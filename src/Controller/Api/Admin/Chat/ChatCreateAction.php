<?php

namespace App\Controller\Api\Admin\Chat;

use App\Constraints as Assert;
use App\Controller\Api\BaseController;
use App\Controller\Api\ValidatorTrait;
use App\DTO\CreateChatDTO;
use App\Entity\Chat;
use App\Entity\Issue;
use App\Entity\User;
use App\Exception\OnlyAdminRoleAcceptableException;
use App\Factory\ChatFactory;
use App\Repository\ChatRepository;
use App\Repository\IssueRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use Throwable;
use function count;

class ChatCreateAction extends BaseController
{
    use ValidatorTrait;
    private IssueRepository $issueRepository;
    private ChatRepository $chatRepository;
    private User $admin;

    protected function initConstraints(): void
    {
        $this->constraints = new Assert\Collection([
            'issue_id' => [
                new Assert\Type('integer'),
                new Assert\Range(['min' => 1]),
                new Assert\NotNull(),
                new Assert\NotBlank(),
            ],
        ]);
    }

    /**
     * @Route("/api/admin/{admin}/chats", name="api-admin-chats-create", methods={"POST"})
     * @throws Throwable
     */
    public function __invoke(User $admin): JsonResponse
    {
        $this->admin = $admin;
        $this->issueRepository = $this->entityManager->getRepository(Issue::class);
        $this->chatRepository = $this->entityManager->getRepository(Chat::class);

        return $this->handler($admin);
    }

    /**
     * @throws Throwable
     */
    public function execute(array $context = [], array $payload = []): array
    {
        $this->initConstraints();
        $errorMessages = $this->contentValidation($payload);
        if (count($errorMessages) > 0) {
            return ['errors' => $errorMessages];
        }

        $issue = $this->issueRepository->find($payload['issue_id']);
        if(is_null($issue)){
            return [
                'errors' => [
                    sprintf('Вопрос с id %d не найден', $payload['issue_id'])
                ],
            ];
        }

        return $this->createChat($issue);
    }

    /**
     * @throws OptimisticLockException
     * @throws OnlyAdminRoleAcceptableException
     * @throws ORMException
     */
    private function createChat(Issue $issue): array
    {
        if (!$this->admin->isAdmin()) {
            throw new OnlyAdminRoleAcceptableException();
        }
        try {
            $chat = ChatFactory::create($this->createDto($issue));
            $this->chatRepository->add($chat);

            return [
                'chat_id' => $chat->getId(),
            ];
        } catch (UniqueConstraintViolationException $throwable){
            return [
                'errors' => [
                    'Чат уже существует'
                ],
            ];
        }
    }

    private function createDto(Issue $issue): CreateChatDTO
    {
        $dto =  new CreateChatDTO();
        $issue->setAdmin($this->admin);
        $dto->issue = $issue;
        return $dto;
    }
}
