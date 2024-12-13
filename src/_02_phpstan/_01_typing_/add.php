<?php

/**
 * PHPDocを使って引数の型指定や返り値の型指定ができる
 * @param int $a
 * @param int $b
 * @return int
 */
function add($a, $b)
{
    return $a + $b;
}

// Parameter #2 $b of function add expects int, string given. PHPStan(argument.type)
echo add(1, '2') . PHP_EOL;

function newAdd(int $a, int $b): int
{
    return $a + $b;
}

// Parameter #2 $b of function newAdd expects int, string given. PHPStan(argument.type)
echo newAdd(1, '2') . PHP_EOL;

/**
 * 警告の赤線がでる世界線来た！！！
 * これがPHPStanの力！！！
 *
 * TypeScriptではトランスパイルのときに型チェックが行われるが
 * PHPでは、PHPStanを用いてCI上で解析を行って警告するのと、
 * PHPは実行時の型チェックによるエラーの二段階で対応している
 *
 * このようにPHPStanを使うことで、型の不整合を事前に検知して警告してくれる
 */
