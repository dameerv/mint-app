<?php

namespace App\Controller\Api\Site\Issue;

use App\Constraints as Assert;
use App\Controller\Api\BaseController;
use App\Controller\Api\ValidatorTrait;
use App\DTO\CreateIssueDTO;
use App\Entity\Issue;
use App\Factory\IssueFactory;
use App\Repository\IssueRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;
use function count;

class IssueCreateAction extends BaseController
{
    use ValidatorTrait;
    private IssueRepository $issueRepository;


    protected function initConstraints(): void
    {
        $this->constraints = new Assert\Collection([
            'title' => [
                new Assert\Type('string'),
                new Assert\NotBlank(),
            ],
            'description' => [
                new Assert\Type('string'),
                new Assert\NotBlank(),
            ],
        ]);
    }

    /**
     * @Route("/api/client/issues", name="api-client-issue-create", methods={"POST"})
     * @throws Throwable
     */
    public function __invoke(): JsonResponse
    {
        $this->issueRepository = $this->entityManager->getRepository(Issue::class);
        return $this->handler();
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

        $issue = IssueFactory::create($this->createDto(
            $payload['title'],
            $payload['description'])
        );

        $this->issueRepository->add($issue);

        return [
            'issue_id' => $issue->getId(),
        ];
    }

    private function createDto($title, $description): CreateIssueDTO
    {
        $dto = new CreateIssueDTO();
        $dto->title = $title;
        $dto->description = $description;

        return $dto;
    }
}
