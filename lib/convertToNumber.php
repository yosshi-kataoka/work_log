<?php
// ◯お題

// 複数枚のトランプのカードを引きます。引いたカードの数値部分を抽出するプログラムを、無名関数もしくはアロー関数を使って書きましょう。

// ◯仕様

// ・カードの数値部分を抽出するconvertToNumber関数を定義してください
// ・convertToNumber関数は引数に任意の数のカードを取り、返り値として各カードの数値部分を抽出した配列を返します
// ・カードはH1〜H13（ハート）、S1〜S13（スペード）、D1〜D13（ダイヤ）、C1〜C13（クラブ）、となります。ただし、Jは11、Qは12、Kは13、Aは1とします

// ◯実行例

// convertToNumber('C7')               // => ['7']
// convertToNumber('H3', 'S10', 'DA')  // => ['3', '10', 'A']

function convertToNumber(string ...$numbers): array
{
  $convertNumber = [];
  foreach ($numbers as $number) {
    $convertNumber[] = (string)mb_substr($number, 1);
  }
  return $convertNumber;
}
