<?php
$dir = dirname(__FILE__);
require_once "{$dir}/Operator.php";
require_once "{$dir}/OrOperator.php";
require_once "{$dir}/AndOperator.php";

function testBoolList($boolList = []) {
  $or = new OrOperator($boolList);
  $and = new AndOperator($boolList);
  $areEqual = "$or" === "$and";
  echo $areEqual ? "\033[0;32m" : "\033[0;31m";
  printf('or operation: %s', $or->getOperation()); echo PHP_EOL;
  printf('__or__ thinks it\'s: %s', $or); echo PHP_EOL;
  printf('and operation: %s', $and->getOperation()); echo PHP_EOL;
  printf('__and__ thinks it\'s: %s', $and); echo PHP_EOL;
  echo "\033[0m"; echo PHP_EOL;
}

testBoolList([true, false]);
testBoolList([false, true, false]);
testBoolList([true, true]);
testBoolList([false, false]);
testBoolList([false, false, true, false, true, false, false, true, true]);
