<?php

namespace App\Controller\Frontend\Site;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function array_merge;

class MainController extends BaseController
{
    /**
     * @Route("/", name="site-main")
     */
    public function __invoke(): Response
    {
        return $this->render(
            'site/messages.html.twig',
                []
        );
    }
}
