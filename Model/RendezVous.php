<?php

	class RendezVous{


		private $id_rdv;
		private $date_debut;
		private $date_fin;
		private $description;

		public function getIdRdv(){
			return $this->id_rdv;
		}

		public function setIdRdv($id){
			$this->id_rdv = $id;
		}

		public function getDateDebut(){
			return $this->date_debut;
		}

		public function setDateDebut($date){
			$this->date_debut = $date;
		}

		public function getDateFin(){
			return $this->date_fin;
		}

		public function setDateFin($date){
			$this->date_fin = $date;
		}

		public function getDescription(){
			return $this->description;
		}

		public function setDescription($desc){
			$this->description = $desc;
		}


	}