<?php

declare(strict_types=1);

namespace App\_01_typing;

class SampleClassCollector
{
    /** @var SampleClass[] */
    private array $sample_class_array; // SampleClass[]のようなクラス配列は使えない

    /**
     * @param SampleClass[] $sample_class_array
     */
    public function __construct(array $sample_class_array)
    {
        $this->sample_class_array = $sample_class_array;
    }

    public function show(): void
    {
        foreach ($this->sample_class_array as $sample_class) {
            $sample_class->show();
        }
    }
}

// arrayが悪魔という話はここにも当てはまる
// arrayは内部の構造や型が外から分からないためPHPDocで補強するのが定石
// ただし、PHPDocはPHP的にはただのコメントなので実行時には何の意味もない
$sample_class_array = new SampleClassCollector([1, 2, 3]); // No Error

// そのため、初期化は問題ないが、実行時にエラーが発生するケースが非常に多い
$sample_class_array->show();

/**
 * 型周りの機能が増えたのはいい事だけど、実行してみないとエラーになるかわからないの怖くない？？
 * せめてエディタ上で警告くらい出してほしいんだけど...
 *
 * あとarrayの中身の型を定義したり、初期化時に適合しているか調べる機能が欲しい！！！
 * そこでPHPStanじゃよ＾＾
 */
