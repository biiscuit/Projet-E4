<?php 

class Database{

	private $user = "root";
	private $pass = "";
	private $dsn = "mysql:host=localhost;dbname=garage";
	//permet de recevoir les informations avec l'encodage utf8
	private $utf8 = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');


	function connect(){

		try {
			// attribut
			return new PDO($this->dsn, $this->user, $this->pass, $this->utf8);
		} catch (PDOException $e) {
			die("Echec de connexion." . $e->getMessage());
		}

	}

}
?>