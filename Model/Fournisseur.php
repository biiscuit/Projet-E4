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

		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getNom(){
			return $this->nom;
		}

		public function setNom($nom){
			$this->nom = $nom;
		}

		public function getAdresse(){
			return $this->adr;
		}

		public function setAdresse($adr){
			$this->adr = $adr;
		}

		public function getVille(){
			return $this->ville;
		}

		public function setVille($ville){
			$this->ville = $ville;
		}

		public function getCP(){
			return $this->cp;
		}

		public function setCP($cp){
			$this->cp = $cp;
		}

		public function getTel(){
			return $this->tel;
		}

		public function setTel($tel){
			$this->tel = $tel;
		}

		public function getFax(){
			return $this->fax;
		}

		public function setFax($fax){
			$this->fax = $fax;
		}

		public function getMail(){
			return $this->mail;
		}

		public function setMail($mail){
			$this->mail = $mail;
		}

	}

?>