<?php 

	class CategorieManager{

		private $idCategorie;
		private $libelle;


		// Getters / Setters (Accesseurs / mutateurs)

		public function getAllCategorie($cnx){
			
			// Requete SQL
			$sql= "SELECT * FROM categories ORDER BY libelle";

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

				$obj->setIdCategorie($record->id_categorie);
				$obj->setLibelle($record->libelle);

				$liste[] = $obj;
			}

			return $liste;
		}

		public function getAllCategorieLimit($cnx,$start,$decal){
			
			// Requete SQL
			$sql= "SELECT * FROM categories ORDER BY libelle LIMIT ?,?";

			// Préparation de la requete
			$req = $cnx->prepare($sql);

			// Execution de la requete
			$req->execute(array($start,$decal));

			// On créer une liste d'objet
			$liste = array();

			// Traitement des enregistrements
			
			// Ne renvoi pas un objet Categorie mais un objet StdClass
			// $test2 = $req->fetchAll(PDO::FETCH_OBJ);

			while($record = $req->fetch(PDO::FETCH_OBJ)){
				$obj = new Categorie();

				$obj->setIdCategorie($record->id_categorie);
				$obj->setLibelle($record->libelle);

				$liste[] = $obj;
			}

			return $liste;
		}

		public function getCategorieById($cnx,$id){

			$sql = 'SELECT * FROM categories WHERE id_categorie=?';
			$req = $cnx->prepare($sql);
			$req->execute(array($id));

			$cat = $req->fetchAll(PDO::FETCH_OBJ);

			$obj = new Categorie();

			$obj->setIdCategorie($cat[0]->id_categorie);
			$obj->setLibelle($cat[0]->libelle);

			return $obj;
		}

	}

?>