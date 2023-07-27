<?php
// A点（$a,$b）,B点($c,$d)
$a = 1;
$b = 1;
$c = 2;
$d = 2;


// ２点間の距離
// $number1 = ($c - $a) ** 2;
// $number2 = ($d - $b) ** 2;
// $answer = ($number1 + $number2);
// var_dump(sqrt($answer)) . PHP_EOL;
echo sqrt((($c - $a) ** 2) + (($d - $b) ** 2)) . PHP_EOL;
