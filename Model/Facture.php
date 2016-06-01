<?php

Class Facture{

	private $num_facture;
	private $num_immat;
	private $id_client;
	private $date_facture;
	private $prix_total;
	private $payer;

	public function setNumFacture($num){
		$this->num_facture = $num;
	}

	public function getNumFacture(){
		return $this->num_facture;
	}

	public function setNumImmat($num){
		$this->num_immat = $num;
	}

	public function getNumImmat(){
		return $this->num_immat;
	}

	public function setIdClient($id){
		$this->id_client=$id;
	}

	public function getIdClient(){
		return $this->id_client;
	}

	public function setDateFacture($date){
		$this->date_facture = $date;
	}

	public function getDateFacture(){
		return $this->date_facture;
	}

	public function setPrixTotal($prix){
		$this->prix_total = $prix;
	}

	public function getPrixTotal(){
		return $this->prix_total;
	}

	public function setPayer($bool){
		$this->payer = $bool;
	}

	public function getPayer(){
		return $this->payer;
	}
}