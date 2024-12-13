<?php

declare(strict_types=1);

namespace App\_02_phpstan\_02\repo;

use PDO;
use PDOStatement;

class Sql
{
    /**
     * @param PDO $pdo
     * @param string $sql
     * @param array<string, string> $params
     * @return PDOStatement
     */
    public static function execute(PDO $pdo, string $sql, array $params): PDOStatement
    {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
