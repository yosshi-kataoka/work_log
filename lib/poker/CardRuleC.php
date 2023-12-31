<?php

namespace Poker;

require_once('CardRuleBase.php');
require_once('PokerCard.php');

use Poker\PokerCard;

class CardRuleC implements CardRuleBase
{
  private const HIGH_CARD = 'high card';
  private const ONE_PAIR = 'one pair';
  private const TWO_PAIR = 'two pair';
  private const THREE_CARD = 'three card';
  private const STRAIGHT = 'straight';
  private const FULL_HOUSE = 'full house';
  private const FOUR_CARD = 'four card';
  private const NUMBER_OF_TWO_PAIR = 2;
  private const NUMBER_OF_ONE_PAIR = 4;
  private const NUMBER_OF_THREE = 3;
  private const NUMBER_OF_FOUR = 4;
  private const THREE_OF_FULL_HOUSE = 3;
  private const TWO_OF_FULL_HOUSE = 2;

  public function getHand(array $pokerCards): string
  {
    $cardRanks = array_map(fn ($pokerCard) => $pokerCard->getRank(), $pokerCards);
    sort($cardRanks);
    $name = self::HIGH_CARD;
    if ($this->isFourCard($cardRanks)) {
      $name = self::FOUR_CARD;
    } elseif ($this->isFullHouse($cardRanks)) {
      $name = self::FULL_HOUSE;
    } elseif ($this->isStraight($cardRanks)) {
      $name =  self::STRAIGHT;
    } elseif ($this->isThreeCard($cardRanks)) {
      $name = self::THREE_CARD;
    } elseif ($this->isTwoPair($cardRanks)) {
      $name =  self::TWO_PAIR;
    } elseif ($this->isOnePair($cardRanks)) {
      $name =  self::ONE_PAIR;
    }
    return $name;
  }

  private function isFourCard(array $cards): bool
  {
    return max(array_count_values($cards)) === self::NUMBER_OF_FOUR;
  }

  private function isFullHouse(array $cards): bool
  {
    return max(array_count_values($cards)) === self::THREE_OF_FULL_HOUSE && min(array_count_values($cards)) === self::TWO_OF_FULL_HOUSE;
  }

  private function isStraight(array $cards): bool
  {
    sort($cards);
    return range($cards[0], $cards[0] + count($cards) - 1) === array_slice($cards, 0, 5) ||
      $this->isMinMax($cards);
  }
  private function isMinMax(array $cards): bool
  {
    return max($cards) - min($cards) === max(PokerCard::CARD_RANK) - 1 && range($cards[0], $cards[0] + count($cards) - 2) === array_slice($cards, 0, 4);
  }
  private function isThreeCard(array $cards): bool
  {
    return max(array_count_values($cards)) === self::NUMBER_OF_THREE;
  }
  private function isTwoPair(array $cards): bool
  {
    return max(array_count_values($cards)) === self::NUMBER_OF_TWO_PAIR && count(array_count_values($cards)) === 3;
  }
  private function isOnePair(array $cards): bool
  {
    return count(array_unique($cards)) === self::NUMBER_OF_ONE_PAIR;
  }
}
