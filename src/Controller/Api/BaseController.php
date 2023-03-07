<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Exception\OnlyAdminRoleAcceptableException;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use GuzzleHttp\Psr7\ServerRequest as Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;

abstract class BaseController extends AbstractController
{
    private ServerRequestInterface $request;
    protected EntityManagerInterface $entityManager;
    protected ValidatorInterface $validator;

    public function __construct(
        EntityManagerInterface $entityManager,
        ValidatorInterface     $validator
    ) {
        $this->request = Request::fromGlobals();
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    /**
     * @throws Throwable
     */
    protected function handler(?User $admin = null): JsonResponse
    {
        return $this->response();
    }

    private function response(): JsonResponse
    {
        try {
            $responseData = $this->execute($this->getContext(), $this->getPayload() ?? []);

            if (isset($responseData['errors']) && count($responseData['errors'])) {
                return $this->failureResponse($responseData);
            }
            return $this->successResponse($responseData);
        } catch (OnlyAdminRoleAcceptableException $exception) {
            return $this->failureResponse([
                'errors' => [$exception->getMessage()]
            ]);
        } catch (Throwable $exception) {
            dd($exception->getMessage());
            return $this->failureResponse([
                'errors' => ['Что то пошло не так, выполните запрос еще раз']
            ]);
        }
    }

    protected function successResponse(array $data): JsonResponse
    {
        return $this->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    protected function failureResponse(array $data): JsonResponse
    {
        return $this->json([
            'success' => false,
            'errors' => $data['errors'],
        ]);
    }

    protected function getRequest(): ServerRequestInterface
    {
        return $this->request;
    }

    protected function getContext(): array
    {
        return $this->request->getQueryParams();
    }

    protected function getPayload()
    {
        return json_decode($this->request->getBody()->getContents(), true);
    }

    abstract public function execute(array $context = [], array $payload = []): array;
}
