<?php
namespace Singleton;

class Connect{
	private static $instance = null;
	private $pdo;

	private function __construct(){}

	public static function getInstance(){
		if(self::$instance == null){
			self::$instance = new Connect;
		}
		return self::$instance;
	}

	public function getPDO(){
		/*
		$this->pdo = new PDO(.....);
		*/
		$this->pdo = "pdo";
		return $this->pdo;
	}
}