<?php

declare(strict_types=1);

namespace App\_01_typing;

use PDO;

class SampleClass
{
    private string $name;
    private int $age;

    private array $array; // 配列型
    private int|float $number; // 複数の型を指定
    private ?string $hint; // null許容型
    private readonly string $readonly; // 読み取り専用プロパティ
    public PDO $pod; // クラス型を指定

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

$sample = (new SampleClass('Taro', 20))->show(); // No Error
$sample = (new SampleClass('Taro', '20'))->show(); // Error 型厳格モードだとエラーになる
