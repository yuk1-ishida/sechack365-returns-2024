<?php

declare(strict_types=1);

use App\Http\Api\HelloWorldAction;
use App\Http\Middleware\FilterWordMiddleware;
use Route\Route;

Route::addRoute('GET', '/hello', [
    'Filter' => [new FilterWordMiddleware()],
    'Action' => new HelloWorldAction()
]);
