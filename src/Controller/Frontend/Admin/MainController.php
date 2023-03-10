<?php

namespace App\Controller\Frontend\Admin;

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
    public function __invoke(): Response
    {
        return $this->render(
            'site/admin/main.html.twig',
                []
        );
    }
}
