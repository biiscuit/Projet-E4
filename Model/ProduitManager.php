<?php

class ProduitManager{

	private $id_prod;
	private $id_fourn;
	private $id_cat;
	private $nom_prod;
	private $prix_prod;
	private $stock_prod;
	private $img_prod;
	private $description;

	public function getAllProduits($cnx){

		$sql = "SELECT * FROM Produits ORDER BY id_prod";
		$req = $cnx->prepare($sql);
		$res = $req->execute();

		$liste = array();

		while($record = $req->fetch(PDO::FETCH_OBJ)){
				$obj = new Produit();

				$obj->setIdProd($record->ID_PROD);
				$obj->setIdFourn($record->ID_FOURN);
				$obj->setIdCat($record->ID_CAT);
				$obj->setNomProd($record->NOM_PROD);
				$obj->setPrixProd($record->PRIX_PROD);
				$obj->setStockProd($record->STOCK_PROD);
				$obj->setImgProd($record->IMG_PROD);
				$obj->setDescription($record->DESCRIPTION);

				$liste[] = $obj;
			}

			return $liste;
	}

	public function getAllProduitsLimit($cnx,$start,$decal){
		
		$sql = "SELECT * FROM produits ORDER BY ID_PROD LIMIT ? , ?";
		$req = $cnx->prepare($sql);
		$req->bindParam(1, $start, PDO::PARAM_INT);
        $req->bindParam(2, $decal, PDO::PARAM_INT);
        $req->execute();

		$liste = array();

		while($record = $req->fetch(PDO::FETCH_OBJ)){
				$obj = new Produit();

				$obj->setIdProd($record->ID_PROD);
				$obj->setIdFourn($record->ID_FOURN);
				$obj->setIdCat($record->ID_CAT);
				$obj->setNomProd($record->NOM_PROD);
				$obj->setPrixProd($record->PRIX_PROD);
				$obj->setStockProd($record->STOCK_PROD);
				$obj->setImgProd($record->IMG_PROD);
				$obj->setDescription($record->DESCRIPTION);

				$liste[] = $obj;
			}

		return $liste;
	}

	public function getNbProduits($cnx){

		$sql = "SELECT count(*) as 'nb_prod' FROM Produits";
		$req = $cnx->query($sql)->fetch(PDO::FETCH_OBJ);

		return $req;
	}

}