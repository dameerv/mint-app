<?php

namespace App\Controller\Api\Admin\Issue;

use App\Controller\Api\BaseController;
use App\Entity\Issue;
use App\Entity\User;
use App\Repository\IssueRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Routing\Annotation\Route;

class GetIssuesAction extends BaseController
{
    private IssueRepository $issueRepository;

    /**
     * @Route("/api/admin/{admin}/issues/new", name="api-manager-new-issues", methods={"GET"})
     * @throws \Throwable
     */
    public function __invoke(User $admin): JsonResponse
    {
        $this->issueRepository = $this->entityManager->getRepository(Issue::class);

        return $this->handler($admin);
    }

    public function execute(array $context = [], array $payload = []): array
    {
        $issues = $this->issueRepository->findBy([
            'admin' => null
        ]);

        return [
            'issues' => $issues,
        ];
    }
}
