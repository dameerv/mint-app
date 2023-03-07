<?php

namespace App\Twig;

use App\Helper\StringHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

use DateTimeInterface;
use DateTime;

class AppExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('cutTextByWords', [$this, 'cutTextByWords']),
            new TwigFunction('sortParams', [$this, 'sortParams']),
            new TwigFunction('ruMonthDate', [$this, 'ruMonthDate']),
        ];
    }

    public function cutTextByWords(string $text, ?int $length = 100): string
    {
        return StringHelper::cutTextByWords($text, $length);
    }

    public function sortParams(string $sortField, array $params = []): array
    {
        unset($params['page']);

        if (! array_key_exists('sort', $params) ||
            $params['sort'] !== $sortField
        ) {
            unset($params['direction']);
            $params['sort'] = $sortField;
            return $params;
        }

        if (! array_key_exists('direction', $params) ||
            $params['direction'] !== 'desc'
        ) {
            $params['direction'] = 'desc';
            return $params;
        }

        $params['direction'] = 'asc';
        return $params;
    }

    public function ruMonthDate(?DateTimeInterface $date): string
    {
        $months = [
            1 => 'января',
            2 => 'февраля',
            3 => 'марта',
            4 => 'апреля',
            5 => 'мая',
            6 => 'июня',
            7 => 'июля',
            8 => 'августа',
            9 => 'сентября',
            10 => 'октября',
            11 => 'ноября',
            12 => 'декабря',
        ];

        if($date === null) {
            $date = new DateTime('now');
        }

        return $date->format('d ' . $months[$date->format('n')] . ' Y г');
    }
}
