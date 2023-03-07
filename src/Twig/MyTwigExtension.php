<?php

namespace App\Twig;

use App\Helper\StringHelper;
use App\Service\SortingUrlGenerator;
use Symfony\Component\HttpFoundation\InputBag;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MyTwigExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('dump', [$this, 'dump']),

        ];
    }

    public function dump(... $vars): void
    {
        foreach ($vars as $var){
            dump($var);
        }
    }
}
