<?php

declare(strict_types=1);

namespace App\_02_phpstan\_02;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\_02_phpstan\_02\utils\PDOFactory;
use PDO;
use App\_02_phpstan\_02\repo\Sql;

function main(): void
{
    echo 'idを入力してください: ';

    $input = trim((string)fgets(STDIN));

    $pdo = PDOFactory::create();

    $user = Sql::execute($pdo, "SELECT * FROM users where id = '$input'", [])
    ->fetch(PDO::FETCH_ASSOC);

    // @phpstan-ignore-next-line
    echo "ID: {$user['id']}, Username: {$user['username']}, Email: {$user['email']}, Created At: {$user['created_at']}\n";
}

main();
