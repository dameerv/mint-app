<?php

namespace App\Controller\Api\Site\Issue;

use App\Controller\Api\BaseController;
use App\Entity\Issue;
use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class GetIssueAction extends BaseController
{
    private Issue $issue;

    /**
     * @Route("/api/admin/{admin}/issues/{issue}", name="api-admins-issue", methods={"GET"})
     * @throws Throwable
     */
    public function __invoke(
        User $admin,
        Issue $issue
    ): JsonResponse {
        $this->issue = $issue;
        return $this->handler($admin);
    }

    /**
     * @throws Throwable
     */
    public function execute(array $context = [], array $payload = []): array
    {
        return [
            'issue' => $this->issue
        ];
    }
}
