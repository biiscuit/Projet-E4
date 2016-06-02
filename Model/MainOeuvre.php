<?php 

	class MainOeuvre{

		private $idMo;
		private $nomMo;
		private $prixMo;


		// Getters / Setters (Accesseurs / mutateurs)

		public function getIdMo(){
			return $this->idMo;
		}

		public function setIdMo($mo){
			$this->idMo = $mo;
		}

		public function getNomMo(){
			return $this->nomMo;
		}

		public function setNomMo($nom){
			$this->nomMo = $nom;
		}

		public function getPrixMo(){
			return $this->prixMo;
		}

		public function setPrixMo($prix){
			$this->prixMo = $prix;
		}

	}

?>