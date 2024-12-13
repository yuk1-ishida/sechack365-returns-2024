<?php

declare(strict_types=1);

namespace App\_02_phpstan\_02\utils;

use PDO;

class PDOFactory
{
    public static function create(): PDO
    {
        $dsn = 'mysql:host=mysql;dbname=sechack;user=sechack;password=sechack';
        $pdo = new PDO($dsn);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}
