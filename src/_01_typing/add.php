<?php

declare(strict_types=1);

function add($a, $b)
{
    return $a + $b;
}

echo add(1, 2) . PHP_EOL; // 3
echo add(1, '2') . PHP_EOL; // 3

function newAdd(int $a, int $b): int
{
    return $a + $b;
}

echo newAdd(1, 2) . PHP_EOL; // 3
// 3 型厳格モードだとエラーになる
echo newAdd(1, '2') . PHP_EOL;
