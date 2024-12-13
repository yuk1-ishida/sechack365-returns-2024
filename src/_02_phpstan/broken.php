<?php

declare(strict_types=1);

namespace App\_02_phpstan;

require __DIR__ . '/../../../vendor/autoload.php';

use App\_02_phpstan\utils\PDOFactory;
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
     */
    public static function getAllUser(PDO $pdo): array
    {
        $pdo->query('SELECT * FROM users');
        return $pdo->findAll();
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
$users = GetUserRepo::getUserById($pdo, '1');
$result = $users->fetch();

if (preg_match('/[&<>"\']/', $result['username']) === ture) {
    echo '特殊文字が含まれています';
    return 0;
}
echo "ユーザー名: {$result['username']}, 年齢: {$result['age']}";
