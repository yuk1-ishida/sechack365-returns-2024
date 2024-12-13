<?php

namespace App;

use Psr\Log\LoggerInterface;

$something = 'Hello, World!';

// インポートするために読込
include_once __DIR__ . '/global.php';

saySomething($something);

class FileService
{
    public static function deleteFile(string $path, LoggerInterface $logger): void
    {
        if (!file_exists($path)) {
            $logger->error('File not found.');
            return;
        }
        unlink($path);
    }
}
