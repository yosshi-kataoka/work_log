<?php
const MAXIMUM_NAME_LENGTH = 10;
echo '名前を入力してください' . PHP_EOL;
$name = trim(fgets(STDIN));

if (mb_strlen($name) < MAXIMUM_NAME_LENGTH) {
  echo '名前の長さはOK！' . PHP_EOL;
} else {
  echo '名前は10文字以内で入力してください' . PHP_EOL;
}
