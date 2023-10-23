<?php

namespace BlackJack;

abstract class User
{
  protected const MAX_POINT = 21;
  protected const SUBTRACT_POINT = 10;
  protected $point = 0;
  protected $hand = [];
  protected $numberOfA = 0;
  abstract public function getName(): string;
  abstract public function drawCard(Deck $deck, int $number): array;
  abstract public function addHand(Card $hands): void;
  abstract public function addPoint(Card $cards): void;
  abstract public function getHand(): array;
  abstract public function getSuit($card): string;
  abstract public function getNumber($card): string;
  abstract protected function getScore($card): int;
  abstract public function getPoint(): int;
}
