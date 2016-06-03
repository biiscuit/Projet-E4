<?php 

	class CategorieManager{
		
		// Getters / Setters (Accesseurs / mutateurs)

		public function getAllCategorie($cnx){
			
			// Requete SQL
			$sql= "SELECT * FROM categories ORDER BY NOM_CAT";

			// Préparation de la requete
			$req = $cnx->prepare($sql);

			// Execution de la requete
			$req->execute();

			// On créer une liste d'objet
			$liste = array();

			// Traitement des enregistrements
			
			// Ne renvoi pas un objet Categorie mais un objet StdClass
			// $test2 = $req->fetchAll(PDO::FETCH_OBJ);

			while($record = $req->fetch(PDO::FETCH_OBJ)){
				$obj = new Categorie();

				$obj->setIdCategorie($record->ID_CAT);
				$obj->setLibelle($record->NOM_CAT);

				$liste[] = $obj;
			}

			return $liste;
		}

		public function getAllCategorieLimit($cnx,$start,$decal){
			
			$sql = "SELECT * FROM categories ORDER BY id_cat LIMIT ?,?";
			$req = $cnx->prepare($sql);

			$req->bindParam(1, $start, PDO::PARAM_INT);
        	$req->bindParam(2, $decal, PDO::PARAM_INT);
			$res = $req->execute();

			$liste = array();

			while($record = $req->fetch(PDO::FETCH_OBJ)){
					$obj = new Categorie();

					$obj->setIdCategorie($record->ID_CAT);
					$obj->setLibelle($record->NOM_CAT);

					$liste[] = $obj;
				}

				return $liste;
		}

		public function getCategorieById($cnx,$id){

			$sql = 'SELECT * FROM categories WHERE ID_CAT=?';
			$req = $cnx->prepare($sql);
			$req->execute(array($id));

			$cat = $req->fetchAll(PDO::FETCH_OBJ);

			$obj = new Categorie();

			$obj->setIdCategorie($cat[0]->ID_CAT);
			$obj->setLibelle($cat[0]->NOM_CAT);

			return $obj;
		}

		public function getNbCategories($cnx){

			$sql = "SELECT count(*) as 'nb_cat' FROM categories";
			$req = $cnx->query($sql)->fetch(PDO::FETCH_OBJ);

			return $req;
		}

		public function getAllProdByCat($cnx,$start,$decal,$id_cat){

			$sql = "SELECT * FROM produits WHERE ID_CAT = ? ORDER BY ID_PROD LIMIT ?,?";
			$req = $cnx->prepare($sql);
			$req->bindParam(1, $id_cat, PDO::PARAM_INT);
			$req->bindParam(2, $start, PDO::PARAM_INT);
	        $req->bindParam(3, $decal, PDO::PARAM_INT);
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

	}

?>