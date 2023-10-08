<?php

namespace BlackJack;

abstract class User
{
  protected $point = 0;
  protected $hand = [];
  abstract public function drawCard(Deck $deck, int $number): array;
  abstract public function addHand(Card $hands): void;
  abstract public function addPoint(Card $cards): void;
  abstract public function getHand(): array;
  abstract public function getSuit($card): string;
  abstract public function getNumber($card): string;
  abstract protected function getScore($card): int;
  abstract public function getPoint(): int;
}
