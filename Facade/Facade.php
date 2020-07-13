<?php

namespace Facade;
use Strategy\{QuickSort,BubbleSort,MergeSort,ArrayRand};

class Facade{
	private $sort1;
	private $sort2;
	private $sort3;

	public function __construct(){
		$this->sort1 = new QuickSort();
		$this->sort2 = new BubbleSort();
		$this->sort3 = new MergeSort();
	}

	public function QuickSort(int $len):void{
		(new ArrayRand($this->sort1,$len))->display();
	}

	public function BubbleSort(int $len):void{
		(new ArrayRand($this->sort2,$len))->display();
	}

	public function MergeSort(int $len):void{
		(new ArrayRand($this->sort3,$len))->display();
	}
}