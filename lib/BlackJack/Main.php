<?php

namespace BlackJack;

require_once('Game.php');

$game = new Game('standardRule');
$game->start();
