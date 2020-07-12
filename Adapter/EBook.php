<?php

namespace Adapter;

class EBook implements IEBook{
	private $content;
	private $page;

	public function __construct(){
		$this->content = [];
		$this->content[1] = "111";
		$this->content[2] = "222";
		$this->content[3] = "333";
		$this->page = 1;
		echo "Titre : Livre Numérique <br>";
	}

	public function display():self{
		echo "Page ".$this->page." : ".$this->content[$this->page]."<br>";
		return $this;	
	}
	public function pass():self{
		$this->page++;
		if($this->page > 3)$this->page = 3;
		return $this;
	}

}