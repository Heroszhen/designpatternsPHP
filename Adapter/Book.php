<?php
namespace Adapter;

class Book implements IBook{
	private $content;
	private $page;

	public function __construct(){
		$this->content = [];
		$this->content[1] = "aaa";
		$this->content[2] = "bbb";
		$this->content[3] = "ccc";
		$this->page = 1;
		echo "Titre : Livre Papier <br>";
	}

	public function read():self{
		echo "Page ".$this->page." : ".$this->content[$this->page]."<br>";
		return $this;	
	}
	public function turn():self{
		$this->page++;
		if($this->page > 3)$this->page = 3;
		return $this;
	}
}