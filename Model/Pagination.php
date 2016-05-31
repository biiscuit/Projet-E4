<?php

class Pagination{

	private $nb_page;
	private $page_actuelle;

	// $start = id du produit que l'on commence à afficher, et $nb_show = nombre de produits qu'on affiche sur une page
	private $start;
	private $decal;

	public function setNbPage($nb_items,$decal){
		$this->nb_page = ceil($nb_items/$decal);
	}

	public function getNbPage(){
		return $this->nb_page;
	}

	public function setPageActuelle($page){
		$this->page_actuelle=$page;		
	}

	public function getPageActuelle(){
		return $this->page_actuelle;
	}

	public function setStart($start=0){
		if($start == 0 || $start == 1){
			return $this->start = 0;
		}
		else{
			return $this->start = ($start-1)*9;
		}
	}

	public function getStart(){
		return $this->start;
	}

	public function setDecal($decal){
		$this->decal = $decal;
	}

	public function getDecal(){
		return $this->decal;
	}
	
}