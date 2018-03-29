<?php namespace Cats;

echo IMG_AFFINE_ROTATE;

function zst(object $b) {}

  class A {
    public function b(object $d) {
      
    }
  }

class Bob extends DateTimeImmutable{}


// 7.1
function swap(&$left, &$right): void {

}

// 7.1
function testReturn(): ?string
{
    return 'elePHPant';
}
// 5.4
trait Dog{}

// 5.6
function add($a, $b, $c) {
  return $a + $b + $c;
}

$operators = [2, 3];
echo add(1, ...$operators);


// 5.6
function f($req, $opt = null, ...$params) {
  // $params is an array containing the remaining arguments.
  printf('$req: %d; $opt: %d; number of params: %d'."\n",
         $req, $opt, count($params));
}


// 5.5
function xrange($start, $limit, $step = 1) {
  for ($i = $start; $i <= $limit; $i += $step) {
      yield $i;
  }
}

// 5.5

password_hash("12");



class Cats {
  function meow(): int {
    return 12;
  }

  function noreturn() {
    return 'emow';
  }
}
echo Cats::class;
echo 12 <=> 12;
$data = [1,2,3];
$d2 = $data[4] ?? 'no';
