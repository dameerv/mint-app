<?php

namespace App\Controller\Frontend\Admin;

use App\Request\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function array_merge;

/**
 * @Route("/admin")
 */
class MainController extends BaseController
{
    /**
     * @Route("", name="client-main")
     */
    public function __invoke(Request $request): Response
    {
        return $this->render(
            'admin/main.html.twig',
                []
        );
    }
}
