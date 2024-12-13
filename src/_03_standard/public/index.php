<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Relay\Relay;
use Route\Route;

try {
    ob_start();

    $psr17Factory = new Psr17Factory();
    $creator = new ServerRequestCreator($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
    $serverRequest = $creator->fromGlobals();

    require_once __DIR__ . '/../route/web.php';

    $queue = Route::findAndRoute($serverRequest, null);

    $relay = new Relay($queue);
    $response = $relay->handle($serverRequest);

    /**
     * @todo : リクエストを取得し、イミュータブルなオブジェクトに変換する
     */

    /**
     * @todo : ルーティング処理を行う
     */

    /**
     * @todo : ルーティングで取得したミドルウェアとコントローラを積み上げた順に実行する
     */

    // エラーがあればログに出力
    if (ob_get_length() > 0) {
        error_log((string)ob_get_contents());
    }
    ob_end_clean();

    $emitter = new SapiEmitter();
    $emitter->emit($response);
} catch (Throwable $e) {
    error_log($e->getMessage());
    error_log($e->getTraceAsString());
    http_response_code(500);
}
