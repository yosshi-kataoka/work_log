<?php
// ◯お題

// ツーカードポーカーのプロパティやメソッドにアクセス権を付けましょう。下記仕様を追加します。

// プレイヤーの人数を2人に変更しましょう
// プログラムを実行すると、与えられた2人のカードをそのまま返します
// テスト駆動で開発しましょう。

// ◯仕様

// プログラムの入力値として「プレイヤー1のカードの配列、プレイヤー2のカードの配列」を取ります。プログラムの返り値として「プレイヤー1のカードの配列、プレイヤー2のカードの配列」を返します

class PokerGame
{
  public function __construct(private array $cards1, private array $cards2)
  {
  }
  public function start(): array
  {
    // 与えられたカードを返す
    return [$this->cards1, $this->cards2];
  }
}
