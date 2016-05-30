<?php 

	class Categorie{

		private $idCategorie;
		private $libelle;


		// Getters / Setters (Accesseurs / mutateurs)

		public function getIdCategorie(){
			return $this->idCategorie;
		}

		public function setIdCategorie($cat){
			$this->idCategorie = $cat;
		}

		public function getLibelle(){
			return $this->libelle;
		}

		public function setLibelle($lib){
			$this->libelle = $lib;
		}
		
	}

?>