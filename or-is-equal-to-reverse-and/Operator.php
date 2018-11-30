<?php

abstract class Operator
{
  const OPERATOR_OR = "OR";
  const OPERATOR_AND = "AND";

  const OR_FORMAT = "(%s)";
  const OR_OPERATOR = " || ";
  const OR_PREFIX = "";
  const AND_FORMAT = "!(%s)";
  const AND_OPERATOR = " && ";
  const AND_PREFIX = "!";

  private $humanBool = [0 => "false", 1 => "true"];

  private $operator;
  private $format;
  private $prefix;
  private $boolList;

  public function __construct(string $operator, array $boolList = [])
  {
    $this->setOperator($operator);
    $this->setBoolList($boolList);
  }

  public function __toString(): string
  {
    $result = $this->assert($this->getBoolList());
    return $this->humanBool[$result];
  }

  public function assert(array $boolList): bool
  {
    return eval(sprintf("return %s;", $this->getOperation($boolList)));
  }

  public function getOperation(array $boolList = []): string
  {
    if (!$boolList) {
      $boolList = $this->boolList;
    }
    $humanBool = [0 => "false", 1 => "true"];
    $humanBoolList = array_map(function($bool) {
      return $this->getPrefix().$this->humanBool[$bool];
    }, $boolList);
    $listString = implode($this->getOperator(), $humanBoolList);
    $operation = sprintf($this->getFormat(), $listString);
    return $operation;
  }

  private function setOperator(string $operator): void
  {
    $this->operator = constant("self::{$operator}_OPERATOR");
    $this->format = constant("self::{$operator}_FORMAT");
    $this->prefix = constant("self::{$operator}_PREFIX");
  }

  private function getOperator(): string
  {
    return $this->operator;
  }

  private function getFormat(): string
  {
    return $this->format;
  }

  private function getPrefix(): string
  {
    return $this->prefix;
  }

  private function setBoolList(array $boolList): void
  {
    $this->boolList = $boolList;
  }

  private function getBoolList(): array
  {
    return $this->boolList;
  }
}
