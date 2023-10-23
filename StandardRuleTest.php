<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\StandardRule;
use BlackJack\Deck;


require_once(__DIR__ . '/../../lib/BlackJack/StandardRule.php');
require_once(__DIR__ . '/../../lib/BlackJack/Card.php');


class StandardRuleTest extends TestCase
{
  public function testGetHand()
  {
    $deck = new Deck();
    $cards = $deck->drawCard(2);
    $standardRule = new StandardRule();
    $this->assertSame(5, $standardRule->getHand($cards));
  }
}
