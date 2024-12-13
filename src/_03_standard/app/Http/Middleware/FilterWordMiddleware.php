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
        /**
         * @todo フィルタリングを書く、引っかかったら new Response(400 で返す
         */

        /**
         * @todo フィルタリングで問題がなければ $handler->handle($request); で次のミドルウェアに流す処理を書く
         */
    }
}
