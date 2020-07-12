<?php

namespace Decorator;

class SubtractDecorator extends CalculatorDecorator{
	public function __construct(IOperator $calculator){
		parent::__construct($calculator);
	}

	public function add(float $a, float $b):float{
		return parent::add($a,$b);
	}

	public function other(float $a, float $b):float{
		return $a - $b;
	}
}