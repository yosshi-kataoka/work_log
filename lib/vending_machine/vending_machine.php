<?php
// ◯お題

// 自動販売機プログラムを単一責任の原則に基づいて設計しましょう。下記の仕様を追加します。

// 押したボタンに応じて、サイダーかコーラが出るようにしましょう。サイダーは100円、コーラは150円とします。100円以外のコインは入れられない仕様はそのままです
// 他の飲み物も追加しましょう

require_once(__DIR__ . '/item.php');
class VendingMachine
{
  private int $depositedCoin = 0;

  public function depositCoin(int $coinAmount): int
  {
    if ($coinAmount === 100) {
      $this->depositedCoin += $coinAmount;
    } elseif ($coinAmount === 200) {
      $this->depositedCoin += $coinAmount;
    }
    return $this->depositedCoin;
  }

  public function pressButton(Item $item): string
  {
    $price = $item->getPrice();
    if ($this->depositedCoin >= $price) {
      $this->depositedCoin -= $price;
      return $item->getName();
    } else {
      return '';
    }
  }
}
