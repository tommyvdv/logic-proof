<?php

class AndOperator extends Operator
{
  public function __construct(array $boolList = [])
  {
    parent::__construct(self::OPERATOR_AND, $boolList);
  }
}
