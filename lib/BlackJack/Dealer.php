<?php

namespace BlackJack;

use BlackJack\User;

require_once('User.php');

class Dealer extends User
{
  private string $name = 'ディーラー';

  public function getName(): string
  {
    return $this->name;
  }

  public function drawCard(Deck $deck, int $number): array
  {
    $hand = $deck->drawCard($number);
    return $hand;
  }

  public function addHand(Card $hands): void
  {
    $this->hand[] = $hands;
  }

  public function addPoint(Card $cards): void
  {
    $this->point += $this->getScore($cards);
    if ($this->getNumber($cards) === 'A') {
      $this->numberOfA++;
    }
    if ($this->point > parent::MAX_POINT && $this->numberOfA > 0) {
      $this->point -= parent::SUBTRACT_POINT;
      $this->numberOfA--;
    }
  }

  public function getHand(): array
  {
    return $this->hand;
  }

  public function getSuit($card): string
  {
    return $card->getSuit();
  }
  public function getNumber($card): string
  {
    return $card->getNumber();
  }
  protected function getScore($card): int
  {
    return $card->getScore();
  }

  public function getPoint(): int
  {
    return $this->point;
  }
}
