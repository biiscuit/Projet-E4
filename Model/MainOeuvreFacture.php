<?php 

	class MainOeuvreFacture{

		private $numFacture;
		private $idClient;
		private $idMo;
		private $nbHeuresMo;
		private $prixMo;
		private $nomMo;


		// Getters / Setters (Accesseurs / mutateurs)

		public function getNumFacture(){
			return $this->numFacture;
		}

		public function setNumFacture($num){
			$this->numFacture = $num;
		}

		public function getIdClient(){
			return $this->idClient;
		}

		public function setIdClient($cnx,$id){

			$sql = "SELECT ID_CLIENT FROM factures WHERE NUM_FACTURE = ?";
			$req = $cnx->prepare($sql);
			$req->execute(array($id));

			$this->idClient = $req->fetch()[0];
		}

		public function getIdMo(){
			return $this->idMo;
		}

		public function setIdMo($mo){
			$this->idMo = $mo;
		}

		public function getNbHeuresMo(){
			return $this->nbHeuresMo;
		}

		public function setNbHeuresMo($nb){
			$this->nbHeuresMo = $nb;
		}

		public function getPrixMo(){
			return $this->prixMo;
		}

		public function setPrixMo($prix){
			$this->prixMo = $prix;
		}

		public function setNomMo($cnx,$id){

			$sql = "SELECT NOM_MO FROM main_oeuvre WHERE ID_MO = ?";
			$req = $cnx->prepare($sql);
			$req->execute(array($id));

			$this->nomMo = $req->fetch()[0];
		}

		public function getNomMo(){
			return $this->nomMo;
		}

	}

?>