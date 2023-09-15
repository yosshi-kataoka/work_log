<?php

namespace Poker\Tests;

use PHPUnit\Framework\TestCase;
use Poker\CardRuleA;
use Poker\PokerCard;

require_once(__DIR__ . '/../../lib/poker/CardRuleA.php');

class CardRuleATest extends TestCase
{
  public function testGetHand()
  {
    $rule = new CardRuleA;
    $this->assertSame(['high card', 0, 6, 4], $rule->getHand([new PokerCard('H5'), new PokerCard('C7')]));
    $this->assertSame(['pair', 1, 8, 8], $rule->getHand([new PokerCard('H9'), new PokerCard('C9')]));
    $this->assertSame(['straight', 2, 13, 12], $rule->getHand([new PokerCard('HA'), new PokerCard('CK')]));
    $this->assertSame(['straight', 2, 1, 13], $rule->getHand([new PokerCard('HA'), new PokerCard('C2')]));
  }

  public function testGetWinner()
  {
    $rule = new CardRuleA;
    $this->assertSame(0, $rule->getWinner(['high card', 0, 6, 4], ['high card', 0, 6, 4]));
    $this->assertSame(0, $rule->getWinner(['straight', 2, 4, 5], ['straight', 2, 4, 5]));
    $this->assertSame(0, $rule->getWinner(['pair', 1, 4, 4], ['straight', 1, 4, 4]));
    $this->assertSame(1, $rule->getWinner(['high card', 0, 5, 3], ['high card', 0, 4, 2]));
    $this->assertSame(1, $rule->getWinner(['pair', 1, 4, 4], ['high card', 0, 4, 2]));
    $this->assertSame(1, $rule->getWinner(['pair', 1, 6, 6], ['pair', 1, 3, 3]));
    $this->assertSame(1, $rule->getWinner(['straight', 2, 5, 6], ['high card', 0, 5, 3]));
    $this->assertSame(1, $rule->getWinner(['straight', 2, 5, 6], ['pair', 1, 5, 5]));
    $this->assertSame(1, $rule->getWinner(['straight', 2, 5, 6], ['straight', 2, 3, 4]));
    $this->assertSame(1, $rule->getWinner(['straight', 2, 13, 12], ['straight', 2, 1, 13]));
    $this->assertSame(2, $rule->getWinner(['high card', 0, 4, 2], ['high card', 0, 5, 3]));
    $this->assertSame(2, $rule->getWinner(['high card', 0, 4, 2], ['pair', 1, 4, 4]));
    $this->assertSame(2, $rule->getWinner(['pair', 1, 3, 3], ['pair', 1, 6, 6]));
    $this->assertSame(2, $rule->getWinner(['high card', 0, 5, 3], ['straight', 2, 5, 6]));
    $this->assertSame(2, $rule->getWinner(['pair', 1, 5, 5], ['straight', 2, 5, 6]));
    $this->assertSame(2, $rule->getWinner(['straight', 2, 3, 4], ['straight', 2, 5, 6]));
    $this->assertSame(2, $rule->getWinner(['straight', 2, 1, 13], ['straight', 2, 13, 12]));
  }
}
