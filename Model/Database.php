<?php 

class Database{

	private $user = "root";
	private $pass = "";
	private $dsn = "mysql:host=localhost;dbname=garage";


	function connect(){

		try {
			return new PDO($this->dsn, $this->user, $this->pass);
		} catch (PDOException $e) {
			die("Echec de connexion." . $e->getMessage());
		}

	}

}
?>