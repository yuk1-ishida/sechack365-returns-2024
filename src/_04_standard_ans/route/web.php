<?php

declare(strict_types=1);

use App\Http\Api\HelloWorldAction;
use Route\Route;

Route::addRoute('GET', '/hello', [
    'Filter' => [],
    'Action' => new HelloWorldAction()
]);
