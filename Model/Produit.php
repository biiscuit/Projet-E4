<?php

Class Produit{

	private $id_prod;
	private $id_fourn;
	private $id_cat;
	private $nom_prod;
	private $prix_prod;
	private $stock_prod;
	private $img_prod;
	private $description;

	public function setIdProd($id){
		$this->id_prod=$id;
	}

	public function getIdProd(){
		return $this->id_prod;
	}

	public function setIdFourn($id){
		$this->id_fourn=$id;
	}

	public function getIdFourn(){
		return $this->id_fourn;
	}

	public function setIdCat($id){
		$this->id_cat=$id;
	}

	public function getIdCat(){
		return $this->id_cat;
	}

	public function setNomProd($nom){
		$this->nom_prod = $nom;
	}

	public function getNomProd(){
		return $this->nom_prod;
	}

	public function setPrixProd($prix){
		$this->prix_prod = $prix;
	}

	public function getPrixProd(){
		return $this->prix_prod;
	}

	public function setStockProd($stock){
		$this->stock_prod = $stock;
	}

	public function getStockProd(){
		return $this->stock_prod;
	}

	public function setImgProd($img){
		$this->img_prod = $img;
	}

	public function getImgProd(){
		//On remplace les backslash par des slashs
		$this->img_prod = str_replace('\\','/', $this->img_prod);

		//on enleve une partie du chemin pour qu'il s'affiche avec wampserver
		$this->img_prod = substr($this->img_prod, 20);

		//Création du chemin relatif
		$this->img_prod = '../Projets/'.$this->img_prod;
		return $this->img_prod;
	}

	public function setDescription($desc){
		$this->description = $desc;
	}

	public function getDescription(){
		return $this->description;
	}
}