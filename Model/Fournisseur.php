<?php 

	class Fournisseur{

		private $id;
		private $nom;
		private $adr;
		private $ville;
		private $cp;
		private $tel;
		private $fax;
		private $mail;


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