<?php

declare(strict_types=1);

namespace App\_02_phpstan;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\_02_phpstan\_02\utils\PDOFactory;
use PDO;
use PDOStatement;

class GetUserRepo
{
    /**
     * 存在するすべてのユーザーを取得するメソッド
     *
     * DB定義
     * users (
     *   id SERIAL PRIMARY KEY,
     *   username VARCHAR(50) NOT NULL,
     *   email VARCHAR(100) NOT NULL UNIQUE,
     *   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     * );
     *
     * @return array<int, array{id: int, username: string, email: string, created_at: string}>
     */
    public static function getAllUser(PDO $pdo): array
    {
        $stmt = $pdo->query('SELECT * FROM users');
        if ($stmt === false) {
            return [];
        }
        return $stmt->fetchAll();
    }

    /**
     * idからユーザーを検索し、取得するメソッド
     *
     * DB定義
     * users (
     *   id SERIAL PRIMARY KEY,
     *   username VARCHAR(50) NOT NULL,
     *   email VARCHAR(100) NOT NULL UNIQUE,
     *   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     * );
     */
    public static function getUserById(PDO $pdo, int $id): PDOStatement|false
    {
        $sql = "SELECT * FROM users where id = '$id'";
        return $pdo->query($sql);
    }
}

$pdo = PDOFactory::create();
$users = GetUserRepo::getUserById($pdo, 1);
if ($users === false) {
    return;
}
/** @var array{id: int, username: string, email: string, created_at: string} */
$result = $users->fetch();

if (preg_match('/[&<>"\']/', $result['username'])) {
    echo '特殊文字が含まれています';
    return 0;
}
echo "ユーザー名: {$result['username']}, email: {$result['email']}" . PHP_EOL;
