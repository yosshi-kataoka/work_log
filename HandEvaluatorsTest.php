<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\StandardRule;
use BlackJack\Deck;
use BlackJack\HandEvaluator;

require_once(__DIR__ . '/../../lib/BlackJack/StandardRule.php');
require_once(__DIR__ . '/../../lib/BlackJack/Card.php');
require_once(__DIR__ . '/../../lib/BlackJack/HandEvaluator.php');


class HandEvaluatorsTest extends TestCase
{
  public function testGetHand()
  {
    $rule = new StandardRule;
    $deck = new Deck();
    $cards = $deck->drawCard(2);
    $handEvaluator = new HandEvaluator($rule);
    $this->assertSame(5, $handEvaluator->getHand($cards));
  }
}
