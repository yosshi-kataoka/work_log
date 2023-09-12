<?php

require_once('CardRuleBase.php');
require_once('PokerCard.php');

class CardRuleA implements CardRuleBase
{
  private const HIGH_CARD = 'high card';
  private const PAIR = 'pair';
  private const STRAIGHT = 'straight';
  private const NUMBER_OF_PAIR = 2;

  public function getHand(array $pokerCards): string
  {
    $cardRanks = array_map(fn ($pokerCard) => $pokerCard->getRank(), $pokerCards);
    $name = self::HIGH_CARD;
    if ($this->isStraight([$cardRanks[0], $cardRanks[1]])) {
      $name =  self::STRAIGHT;
    } elseif ($this->isPair([$cardRanks[0], $cardRanks[1]])) {
      $name =  self::PAIR;
    }
    return $name;
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
}
