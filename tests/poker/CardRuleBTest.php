<?php

namespace Poker\Tests;

use PHPUnit\Framework\TestCase;
use Poker\CardRuleB;
use Poker\PokerCard;

require_once(__DIR__ . '/../../lib/poker/CardRuleB.php');

class CardRuleBTest extends TestCase
{
  public function testGetHand()
  {
    $rule = new CardRuleB;
    $this->assertSame(['high card', 0, 6, 4, 2], $rule->getHand([new PokerCard('H5'), new PokerCard('C7'), new PokerCard('D3')]));
    $this->assertSame(['high card', 0, 13, 12, 1], $rule->getHand([new PokerCard('HA'), new PokerCard('CK'), new PokerCard('D2')]));
    $this->assertSame(['pair', 1, 4, 4, 2], $rule->getHand([new PokerCard('H5'), new PokerCard('C5'), new PokerCard('D3')]));
    $this->assertSame(['straight', 2, 1, 2, 13], $rule->getHand([new PokerCard('HA'), new PokerCard('C2'), new PokerCard('D3')]));
    $this->assertSame(['straight', 2, 13, 12, 11], $rule->getHand([new PokerCard('HA'), new PokerCard('CK'), new PokerCard('DQ')]));
    $this->assertSame(['three card', 3, 13, 13, 13], $rule->getHand([new PokerCard('HA'), new PokerCard('CA'), new PokerCard('DA')]));
  }

  public function testGetWinner()
  {
    $rule = new CardRuleB;
    // $this->assertSame(2, $rule->getWinner(['high card', 0, 6, 3, 4], ['pair', 1, 6, 4, 4]));
    // $this->assertSame(2, $rule->getWinner(['high card', 0, 5, 3, 7], ['straight', 2, 5, 6, 7]));
    // $this->assertSame(2, $rule->getWinner(['high card', 0, 6, 4, 2], ['three card', 3, 5, 5, 5]));
    // $this->assertSame(1, $rule->getWinner(['straight', 2, 5, 6, 7], ['pair', 1, 3, 3, 7]));
    // $this->assertSame(1, $rule->getWinner(['three card', 3, 4, 4, 4], ['pair', 1, 4, 4, 2]));
    // $this->assertSame(1, $rule->getWinner(['three card', 3, 4, 4, 4], ['straight', 3, 3, 2, 4]));
    // $this->assertSame(1, $rule->getWinner(['high card', 0, 6, 4, 2], ['high card', 0, 6, 3, 2]));
    // $this->assertSame(2, $rule->getWinner(['high card', 0, 6, 3, 2], ['high card', 0, 6, 4, 2]));
    // $this->assertSame(1, $rule->getWinner(['high card', 0, 6, 4, 3], ['high card', 0, 6, 4, 2]));
    // $this->assertSame(0, $rule->getWinner(['high card', 0, 6, 4, 3], ['high card', 0, 6, 4, 3]));
    // $this->assertSame(1, $rule->getWinner(['pair', 1, 3, 3, 5], ['pair', 1, 2, 2, 3]));
    // $this->assertSame(2, $rule->getWinner(['pair', 1, 12, 12, 5], ['pair', 1, 13, 13, 5]));
    // $this->assertSame(1, $rule->getWinner(['pair', 1, 4, 4, 7], ['pair', 1, 4, 4, 6]));
    // $this->assertSame(0, $rule->getWinner(['pair', 1, 3, 3, 5], ['pair', 1, 3, 3, 5]));
    // $this->assertSame(1, $rule->getWinner(['straight', 2, 10, 11, 12], ['straight', 2, 6, 5, 4]));
    // $this->assertSame(1, $rule->getWinner(['straight', 2, 11, 12, 13], ['straight', 2, 10, 11, 12]));
    $this->assertSame(1, $rule->getWinner(['straight', 2, 4, 5, 6], ['straight', 2, 1, 2, 13]));
    $this->assertSame(0, $rule->getWinner(['straight', 2, 4, 5, 6], ['straight', 2, 4, 5, 6]));
    $this->assertSame(2, $rule->getWinner(['three card', 3, 2, 2, 2], ['three card', 3, 13, 13, 13]));
    $this->assertSame(2, $rule->getWinner(['three card', 3, 12, 12, 12], ['three card', 3, 13, 13, 13]));
    $this->assertSame(2, $rule->getWinner(['three card', 3, 1, 1, 1], ['three card', 3, 2, 2, 2]));
  }
}
