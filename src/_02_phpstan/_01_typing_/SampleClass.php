<?php

// declare(strict_types=1);

namespace App\_01_typing;

use PDO;

class SampleClass
{
    private string $name;
    private int $age;
    public string $comment;
    private PDO $unused_property; // unusedなので警告

    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function show(): void // 返り値の型指定
    {
        echo "{$this->name} is {$this->age} years old." . PHP_EOL;
    }
}

$sample = new SampleClass('Taro', 20);
$sample->show();
$sample->comment = null; // null許容型ではないのでエラー
