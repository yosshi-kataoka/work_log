<?php

namespace Poker\Tests;

use PHPUnit\Framework\TestCase;
use Poker\PokerHandEvaluator;
use Poker\CardRuleA;
use Poker\CardRuleB;
use Poker\PokerCard;

require_once(__DIR__ . '/../../lib/poker/PokerHandEvaluator.php');

class PokerHandEvaluatorTest extends TestCase
{
  public function testGetHand()
  {
    // カードが2枚の場合
    $handEvaluator = new PokerHandEvaluator(new CardRuleA());
    $this->assertSame(['straight', 2, 13, 12], $handEvaluator->getHand([new PokerCard('DA'), new PokerCard('SK')]));

    // カードが3枚の場合
    $handEvaluator = new PokerHandEvaluator(new CardRuleB());
    $this->assertSame(['straight', 2, 1, 2, 13,], $handEvaluator->getHand([new PokerCard('DA'), new PokerCard('S2'), new PokerCard('C3')]));
  }

  public function testGetWinner()
  {
    // カードが２枚の場合
    $handEvaluator1 = new PokerHandEvaluator(new CardRuleA());
    $this->assertSame(0, $handEvaluator1->getWinner(['high card', 0, 2, 5], ['high card', 0, 2, 5]));
    $this->assertSame(2, $handEvaluator1->getWinner(['high card', 0, 2, 5], ['pair', 1, 2, 5]));
    $this->assertSame(2, $handEvaluator1->getWinner(['high card', 0, 2, 5], ['straight', 1, 2, 3]));
    $this->assertSame(1, $handEvaluator1->getWinner(['high card', 0, 5, 2], ['high card', 0, 2, 3]));
    $this->assertSame(2, $handEvaluator1->getWinner(['pair', 1, 2, 2], ['pair', 1, 3, 3]));
    $this->assertSame(2, $handEvaluator1->getWinner(['pair', 1, 2, 2], ['straight', 2, 2, 3]));
    $this->assertSame(2, $handEvaluator1->getWinner(['straight', 2, 2, 3], ['straight', 2, 3, 4]));
    $this->assertSame(1, $handEvaluator1->getWinner(['straight', 2, 13, 1], ['straight', 2, 1, 13]));

    //カードが３枚の場合
    $handEvaluator2 = new PokerHandEvaluator(new CardRuleB);
    $this->assertSame(0, $handEvaluator2->getWinner(['high card', 0, 2, 5, 3], ['high card', 0, 2, 5, 3]));
    $this->assertSame(1, $handEvaluator2->getWinner(['high card', 0, 6, 3, 2], ['high card', 0, 5, 3, 2]));
    $this->assertSame(1, $handEvaluator2->getWinner(['high card', 0, 5, 3, 2], ['high card', 0, 5, 2, 1]));
    $this->assertSame(1, $handEvaluator2->getWinner(['high card', 0, 5, 3, 2], ['high card', 0, 5, 3, 1]));
    $this->assertSame(2, $handEvaluator2->getWinner(['high card', 0, 2, 5, 3], ['pair', 1, 2, 2, 3]));
    $this->assertSame(2, $handEvaluator2->getWinner(['high card', 0, 2, 5, 3], ['straight', 2, 2, 3, 4]));
    $this->assertSame(2, $handEvaluator2->getWinner(['high card', 0, 2, 5, 3], ['three card', 3, 3, 3, 3]));
    $this->assertSame(2, $handEvaluator2->getWinner(['pair', 1, 2, 2, 3], ['pair', 1, 3, 3, 4]));
    $this->assertSame(1, $handEvaluator2->getWinner(['pair', 1, 5, 5, 3], ['pair', 1, 2, 2, 4]));
    $this->assertSame(2, $handEvaluator2->getWinner(['pair', 1, 2, 2, 3], ['pair', 1, 2, 2, 4]));
    $this->assertSame(2, $handEvaluator2->getWinner(['pair', 1, 2, 2, 3], ['straight', 2, 2, 3, 4]));
    $this->assertSame(1, $handEvaluator2->getWinner(['pair', 1, 2, 2, 3], ['high card', 0, 13, 12, 1]));
    $this->assertSame(2, $handEvaluator2->getWinner(['pair', 1, 2, 2, 3], ['three card', 3, 3, 3, 3]));
    $this->assertSame(0, $handEvaluator2->getWinner(['straight', 2, 2, 3, 4], ['straight', 2, 2, 3, 4]));
    $this->assertSame(2, $handEvaluator2->getWinner(['straight', 2, 2, 3, 4], ['straight', 2, 5, 6, 7]));
    $this->assertSame(2, $handEvaluator2->getWinner(['straight', 2, 2, 3, 4], ['three card', 3, 3, 3, 3]));
    $this->assertSame(0, $handEvaluator2->getWinner(['three card', 3, 3, 3, 3], ['three card', 3, 3, 3, 3]));
    $this->assertSame(1, $handEvaluator2->getWinner(['three card', 3, 5, 5, 5], ['three card', 3, 3, 3, 3]));
  }
}
