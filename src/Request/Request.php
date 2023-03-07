<?php

namespace App\Request;

use Psr\Http\Message\ServerRequestInterface;
use GuzzleHttp\Psr7\ServerRequest as BaseRequest;

class Request extends BaseRequest implements ServerRequestInterface
{
        public function __construct(string $method, $uri, array $headers = [], $body = null, string $version = '1.1', array $serverParams = [])
        {
            parent::__construct($method, $uri, $headers, $body, $version, $serverParams);
        }
}