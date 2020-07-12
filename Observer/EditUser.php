<?php
namespace Observer;

class EditUser implements \SplObserver{
	public function update(\SplSubject $subject){
		echo $subject->getLastname()." ".$subject->getFirstname()." : ".$subject->getEmail()."<br>";
		/*
			update into mysql
		*/
	}
}