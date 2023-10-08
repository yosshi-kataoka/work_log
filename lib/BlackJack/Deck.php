<?php

namespace BlackJack;

require_once('Card.php');

use BlackJack\Card;

class Deck
{
  private const CARD_RANK = [
    'A' => 1,
    '2' => 2,
    '3' => 3,
    '4' => 4,
    '5' => 5,
    '6' => 6,
    '7' => 7,
    '8' => 8,
    '9' => 9,
    '10' => 10,
    'J' => 10,
    'Q' => 10,
    'K' => 10,
  ];
  public function __construct(private array $card = [])
  {
  }

  public function createDeck(): array
  {
    foreach (['ハート', 'クラブ', 'スペード', 'ダイア'] as $suit) {
      foreach (self::CARD_RANK as $number => $score) {
        $this->card[] = new Card($suit, $number, $score);
      }
    }
    shuffle($this->card);
    return $this->card;
  }

  public function drawCard(int $number): array
  {
    $card = array_slice($this->card, 0, $number);
    array_splice($this->card, 0, $number);
    return $card;
  }


  public function getCard(): array
  {
    return $this->card;
  }
}
