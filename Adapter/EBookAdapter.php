<?php
namespace Adapter;

class EBookAdapter implements IEBook{
	private $book;

	public function __construct(Book $book){
		$this->book = $book;
		echo "Titre : Livre Papier <br>";
	}

	public function display():self{
		$this->book->read();
		return $this;	
	}
	public function pass():self{
		$this->book->turn();
		return $this;
	}
}