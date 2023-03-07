<?php

namespace App\Controller\Frontend;

use GuzzleHttp\Psr7\ServerRequest as Request;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    private ServerRequestInterface $request;

    public function __construct(
    ) {
        $this->request = Request::fromGlobals();
    }
}
