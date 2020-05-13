<?php

class bdd
{
	private $connexion;

	public function __construct()
	{
		try {
			$this->connexion = new PDO("mysql:host=localhost;dbname=cinetech", "root", "");
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getco()
	{
		return $this->connexion;
	}

	public function close()
	{
		$this->connexion = null;
    }
}