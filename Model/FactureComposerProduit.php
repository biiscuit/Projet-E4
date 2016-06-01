<?php

Class FactureComposerProduit{

	private $num_facture;
	private $id_prod;
	private $quantite_prod;
	private $prix_effectif_prod;

	public function setNumFacture($num){
		$this->num_facture = $num;
	}

	public function getNumFacture(){
		return $this->num_facture;
	}

	public function setIdProd($id){
		$this->id_prod = $id;
	}

	public function getIdProd(){
		return $this->id_prod;
	}

	public function setQuantiteProd($qte){
		$this->quantite_prod=$qte;
	}

	public function getQuantiteProd(){
		return $this->quantite_prod;
	}

	public function setPrixProd($prix){
		$this->prix_effectif_prod = $prix;
	}

	public function getPrixProd(){
		return $this->prix_effectif_prod;
	}

}