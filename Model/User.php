<?php

	// Classe gérant les utilisateurs
	class User{

		private $id_client = null;

		function setId($id){
			$this->id_client = $id;
		}

		function getId(){
			return $this->id_client;
		}

		function seConnecter($cnx,$mail,$pass){

			$sql = "SELECT ID_CLIENT FROM clients WHERE MAIL_CLIENT=? AND MDP_CLIENT=SHA1(?)";
			$req = $cnx->prepare($sql);
			$res = $req->execute(array($mail,$pass));
			$res = $req->fetch(PDO::FETCH_OBJ);

			// $res == false s'il n'a aucun résultat
			if( $res != false ){
				$this->setId($res->ID_CLIENT);
				return true;
			}
			else{
				return false;
			}
		}

		function inscrireClient($tableau){

			var_dump($tableau);
		}


	}
?>