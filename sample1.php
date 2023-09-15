<?php

class Test
{
  public function aa()
  {
    echo 'newを用いてインスタンス化する必要があります' . PHP_EOL;
  }

  public static function bb()
  {
    echo 'staticな呼び出しです' . PHP_EOL;
  }
}

$test = new Test();
echo $test->aa() . PHP_EOL; //メソッドを使用するにはインスタンス化する必要がある。

echo Test::bb() . PHP_EOL;//staticメソッドは、インスタンス化せずにどこからでも使用できる。
//そのため、複数のクラスをまとめるときなど、限定的に使用する。
