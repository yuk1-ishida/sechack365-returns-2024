<?php

declare(strict_types=1);

namespace Route;

use App\Http\Helper\NotFoundAction;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Log\LoggerInterface;

require __DIR__ . '/../vendor/autoload.php';

class Route
{
    /**
     * @var array{
     *     GET?: array<string, array{Filter: MiddlewareInterface[], Action: MiddlewareInterface}>,
     *     POST?: array<string, array{Filter: MiddlewareInterface[], Action: MiddlewareInterface}>,
     * }
     */
    private static array $routes = [];

    /**
     * @param ServerRequestInterface $request
     * @param LoggerInterface|null $logger
     * @return MiddlewareInterface[]
     */
    public static function findAndRoute(ServerRequestInterface $request, ?LoggerInterface $logger): array
    {
        $method = $request->getMethod();
        $path = $request->getUri()->getPath();

        $action = self::$routes[$method][$path] ?? null;
        if ($action === null) {
            return [new NotFoundAction()];
        }

        return array_merge(
            $action['Filter'],
            [$action['Action']]
        );
    }

    /**
     * @param 'GET'|'POST' $method
     * @param string $path
     * @param array{Filter: MiddlewareInterface[], Action: MiddlewareInterface} $action
     * @return void
     */
    public static function addRoute(string $method, string $path, array $action): void
    {
        self::$routes[$method][$path] = $action;
    }
}
