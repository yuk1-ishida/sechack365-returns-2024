<?php

declare(strict_types=1);

use App\Http\Api\HelloWorldAction;
use App\Http\Middleware\FilterWordMiddleware;
use Route\Route;

/**
 * @todo: ルート情報を書く
 */
Route::addRoute('POST', '/hello', [
    'Filter' => [new FilterWordMiddleware()],
    'Action' => new HelloWorldAction()
]);
