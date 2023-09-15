<?php

namespace Poker;

require_once('CardRuleBase.php');
require_once('PokerCard.php');

use Poker\PokerCard;

class CardRuleB implements CardRuleBase
{
  private const HIGH_CARD = 'high card';
  private const PAIR = 'pair';
  private const STRAIGHT = 'straight';
  private const THREE_CARD = 'three card';
  private const NUMBER_OF_PAIR = 2;
  private const NUMBER_OF_THREE = 1;
  private const INVALID_STRAIGHT_NUMBER = 26;

  private const HANDS_STRENGTH = [
    'high card' => 0,
    'pair' => 1,
    'straight' => 2,
    'three card' => 3,
  ];
  public function getHand(array $pokerCards): array
  {
    $cardRanks = array_map(fn ($pokerCard) => $pokerCard->getRank(), $pokerCards);
    rsort($cardRanks);
    $primary = max($cardRanks);
    $secondary = $cardRanks[1];
    $tertiary =  min($cardRanks);
    $name = self::HIGH_CARD;
    if ($this->isThreeCard([$cardRanks[0], $cardRanks[1], $cardRanks[2]])) {
      $name = self::THREE_CARD;
    } elseif ($this->isInvalidStraight([$cardRanks[0], $cardRanks[1], $cardRanks[2]])) {
    } elseif ($this->isStraight([$cardRanks[0], $cardRanks[1], $cardRanks[2]])) {
      if ($this->isMinMax([$cardRanks[0], $cardRanks[1], $cardRanks[2]])) {
        $primary = min(PokerCard::CARD_RANK);
        $tertiary = max(PokerCard::CARD_RANK);
      }
      $name =  self::STRAIGHT;
    } elseif ($this->isPair([$cardRanks[0], $cardRanks[1], $cardRanks[2]])) {
      $name =  self::PAIR;
    }

    $hands = [
      $name,
      self::HANDS_STRENGTH[$name],
      $primary,
      $secondary,
      $tertiary,
    ];
    return $hands;
  }

  public function isThreeCard(array $cards): bool
  {
    return count(array_unique($cards)) === self::NUMBER_OF_THREE;
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
