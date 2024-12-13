<?php

namespace App\Http\Middleware;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FilterWordMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!isset($request->getParsedBody()['word'])){
            return new Response(400, ['Content-Type' => 'application/json'], (string)json_encode(['error'=>'body needed']));
        }
        return $handler->handle($request);
    }
}
