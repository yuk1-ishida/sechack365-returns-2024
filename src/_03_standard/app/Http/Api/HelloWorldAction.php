<?php

namespace App\Http\Api;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HelloWorldAction implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /**
         * @todo hello {word}となるようにレスポンスを組み立てる
         * レスポンスは new Response(...)で組み立てる
         */
    }
}
