<?php
namespace Decorator;

class calculator implements IOperator{

	public function add(float $a, float $b):float{
		return $a + $b;
	}
}