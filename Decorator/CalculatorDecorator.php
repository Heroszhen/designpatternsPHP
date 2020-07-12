<?php

namespace Decorator;

abstract class CalculatorDecorator implements IOperator{
	protected $calculator;

	public function __construct(IOperator $cal){
		$this->calculator = $cal;
	}

	public function add(float $a, float $b):float{
		return $this->calculator->add($a,$b);
	}

	abstract function other(float $a, float $b):float;
}