<?php

namespace Poker;

require_once('CardRuleBase.php');
require_once('PokerCard.php');

use Poker\PokerCard;

class CardRuleA implements CardRuleBase
{
  private const HIGH_CARD = 'high card';
  private const PAIR = 'pair';
  private const STRAIGHT = 'straight';
  private const NUMBER_OF_PAIR = 2;
  private const HANDS_STRENGTH = [
    'high card' => 0,
    'pair' => 1,
    'straight' => 2,
  ];

  public function getHand(array $pokerCards): array
  {
    $cardRanks = array_map(fn ($pokerCard) => $pokerCard->getRank(), $pokerCards);
    $primary = max($cardRanks);
    $secondary = min($cardRanks);
    $name = self::HIGH_CARD;
    if ($this->isStraight([$cardRanks[0], $cardRanks[1]])) {
      if ($this->isMinMax([$cardRanks[0], $cardRanks[1]])) {
        $primary = min(PokerCard::CARD_RANK);
        $secondary = max(PokerCard::CARD_RANK);
      }
      $name =  self::STRAIGHT;
    } elseif ($this->isPair([$cardRanks[0], $cardRanks[1]])) {
      $name =  self::PAIR;
    }
    $hands = [
      $name,
      self::HANDS_STRENGTH[$name],
      $primary,
      $secondary,
    ];
    return $hands;
  }
  public function isStraight(array $cards): bool
  {
    sort($cards);
    return range($cards[0], $cards[0] + count($cards) - 1) === $cards || $this->isMinMax($cards);
  }
  public function isMinMax(array $cards): bool
  {
    return abs(max($cards) - min($cards)) === (max(PokerCard::CARD_RANK) - min(PokerCard::CARD_RANK));
  }
  public function isPair(array $cards): bool
  {
    return max(array_count_values($cards)) === self::NUMBER_OF_PAIR;
  }

  public function getWinner(array $hand1, array $hand2): int
  {
    for ($i = 1; $i <= (count($hand1)); $i++) {
      if ($hand1[$i] > $hand2[$i]) {
        return 1;
      } elseif ($hand1[$i] < $hand2[$i]) {
        return 2;
      }
    }
    return 0;
  }
}
