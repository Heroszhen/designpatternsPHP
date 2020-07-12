<?php
namespace Strategy;

class ArrayRand{
	private $sort;
	private $len;
	private $tab;

	public function __construct(ISort $s,int $len){
		$this->sort = $s;
		$this->len = $len;
		$this->tab = [];
	}

	public function display():void{
		for($i = 0;$i < $this->len;$i++)$this->tab[] = rand(-100,100);
		$this->printTab();
		$this->tab = $this->sort->run($this->tab);
		$this->printTab();
	}

	public function printTab(){
		echo "<pre>";
		print_r($this->tab);
		echo "</pre>";
	}
}