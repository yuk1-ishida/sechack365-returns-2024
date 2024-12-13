<?php

declare(strict_types=1);

namespace App\_01_typing;

class ValidateArray
{
    /**
     * @var array<int,
     * array{
     *  user_id: int,
     *  user_name: string,
     *  user_email: string
     * }> $user_array
     */
    public array $user_array;
}

$arr = new ValidateArray();
/**
 * Property App\_01_typing\ValidateArray::$user_array
 * (array<int, array{user_id: int, user_name: string, user_email: string}>)
 * does not accept array{1, 2, 3}.
 *
 * Arrayの構造も型で指定できるので、構造の不一致を検知できる
 */
$arr->user_array = [1, 2, 3];

$arr->user_array = [
    [
        'user_id' => 1,
        'user_name' => 'Taro',
        'user_email' => 'info@example.com'
    ]
];

/**
 * PHPStanを利用することで実質TypeScript的な型チェックが可能になる。
 * ただし現状は言語側のアップデートが追いついていないこともあり、
 * TypeScriptほど高機能ではない。
 *
 * 他にも
 *  - 独自でルールを定義して警告するパターンを追加できる機能
 *  - ジェネリクスと同等のことを行える機能
 *  - 引数の値に応じて返り値の型を特定する機能
 *  - 導入に対する補助機能
 *  - などなどがある。
 */
