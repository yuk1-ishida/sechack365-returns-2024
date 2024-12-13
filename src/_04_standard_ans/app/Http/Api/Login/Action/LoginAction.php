<?php

namespace App\Http\Api\Login\Action;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginAction implements MiddlewareInterface
{
    private array $users = [
        'user1' => 'password1',
        'user2' => 'password2'
    ];

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $data = json_decode((string)$request->getBody(), true);

        if (!isset($data['username'], $data['password'])) {
            return new Response(400, ['Content-Type' => 'application/json'], (string)json_encode(['error' => 'Invalid input']));
        }

        $username = $data['username'];
        $password = $data['password'];

        // 認証チェック
        if (isset($this->users[$username]) && $this->users[$username] === $password) {
            // セッションにユーザー情報を保存
            $_SESSION['username'] = $username;

            return new Response(200, ['Content-Type' => 'application/json'], (string)json_encode([
                'message' => 'Login successful',
                'username' => $username
            ]));
        }

        return new Response(401, ['Content-Type' => 'application/json'], (string)json_encode(['error' => 'Invalid credentials']));
    }
}
