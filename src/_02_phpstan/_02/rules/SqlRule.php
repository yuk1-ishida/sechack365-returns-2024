<?php

declare(strict_types=1);

namespace App\_02_phpstan\_02\rules;

use PhpParser\Node;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Scalar\String_;
use PHPStan\Rules\Rule;
use PHPStan\Analyser\Scope;

/**
 * @implements Rule<StaticCall>
 */
class SqlRule implements Rule
{
    public function getNodeType(): string
    {
        return StaticCall::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        /**
         * @todo 関係ないクラスやメソッドで警告が行われる必要はないので、
         * 以下の条件に当てはまらない場合は空配列を返して処理を終了するように実装する
         *
         * $node->classが「App\chap1\_02\repo\Sql」である
         * $node->nameが「execute」である
         */
        if (
            // @phpstan-ignore-next-line
            (string)$node->class !== 'App\_02_phpstan\_02\repo\Sql' ||
            // @phpstan-ignore-next-line
            (string)$node->name !== 'execute'
        ) {
            return [];
        }

        /**
         * @todo 第二引数の型がString型であることを確認する
         * もしString型ではない場合、変数と結合されていたり、文字列ではないものが渡されている可能性があるため警告を行う
         * 警告の文言は自由に設定してください
         *
         * :ヒント:
         * $node->getArgs()で引数の配列を取得できる。第二引数は配列の何番目の要素だろうか？
         * String型であることは 'instanceof Node\Scalar\String_' を使って比較できる
         */
        if (!$node->getArgs()[1]->value instanceof Node\Scalar\String_) {
            return ['Sql::execute()に代入するクエリは文字列リテラルである必要があります。'];
        }

        /**
         * @todo PHPではダブルクォートを使うと変数と文字列を結合できる。
         * これはSQLインジェクションを招くことになるのでif文を使って第二引数がシングルクオートで囲われていることを確認する
         *
         * :ヒント:
         * 引数にはAttributeが付与されているので、それを使って判定する
         *
         * 第二引数のAttributeは$node->getArgs()[1]->value->getAttributes()で取得できる
         * 第二引数のAttributeのkindキーにクオーテーションなどに関する情報が入っている。
         * その配列の中に「String::KIND_SINGLE_QUOTED」か「String::KIND_NOWDOC」が存在しない場合は警告を出す
         *
         * 1つ前のtodoが正しく実装できていないと、この検査がうまく動作しない場合があるので注意
         */
        $attributes = $node->getArgs()[1]->value->getAttributes();
        if (!in_array($attributes['kind'], [String_::KIND_SINGLE_QUOTED, String_::KIND_NOWDOC])) {
            return ['Sql::execute()に代入するクエリはSQLインジェクション防止のため、シングルクォートで記述する必要があります。'];
        }

        // エラーに引っかからない場合は警告がいらないので空の配列を返す
        return [];
    }
}
