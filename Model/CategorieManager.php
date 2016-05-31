<?php 

	class CategorieManager{

		private $idCategorie;
		private $libelle;


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
			
			$sql = "SELECT * FROM categories ORDER BY id_cat";
			$req = $cnx->prepare($sql);
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

	}

?>