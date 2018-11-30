<?php

class OrOperator extends Operator
{
  public function __construct(array $boolList = [])
  {
    parent::__construct(self::OPERATOR_OR, $boolList);
  }
}
