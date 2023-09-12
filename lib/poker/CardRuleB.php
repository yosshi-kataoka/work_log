<?php

require_once('CardRuleBase.php');
require_once('PokerCard.php');

class CardRuleB implements CardRuleBase
{
  private const HIGH_CARD = 'high card';
  private const PAIR = 'pair';
  private const STRAIGHT = 'straight';
  private const THREE_CARD = 'three card';
  private const NUMBER_OF_PAIR = 2;
  private const NUMBER_OF_THREE = 3;
  private const INVALID_STRAIGHT_NUMBER = 26;

  public function getHand(array $pokerCards): string
  {
    $cardRanks = array_map(fn ($pokerCard) => $pokerCard->getRank(), $pokerCards);
    $name = self::HIGH_CARD;
    if ($this->isThreeCard([$cardRanks[0], $cardRanks[1], $cardRanks[2]])) {
      $name = self::THREE_CARD;
    } elseif ($this->isInvalidStraight([$cardRanks[0], $cardRanks[1], $cardRanks[2]])) {
    } elseif ($this->isStraight([$cardRanks[0], $cardRanks[1], $cardRanks[2]])) {
      $name =  self::STRAIGHT;
    } elseif ($this->isPair([$cardRanks[0], $cardRanks[1], $cardRanks[2]])) {
      $name =  self::PAIR;
    }
    return $name;
  }

  public function isThreeCard(array $cards): bool
  {
    return max(array_count_values($cards)) === self::NUMBER_OF_THREE;
  }

  public function isInvalidStraight(array $cards): bool
  {
    return  abs(max($cards) - min($cards)) === (max(PokerCard::CARD_RANK) - 1) && array_sum($cards) === self::INVALID_STRAIGHT_NUMBER;
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
