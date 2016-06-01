<?php 

	class FournisseurManager{

		private $id;
		private $nom;
		private $adr;
		private $ville;
		private $cp;
		private $tel;
		private $fax;
		private $mail;

		public function getAllFournisseur($cnx){
			
			// Requete SQL
			$sql= "SELECT * FROM fournisseurs ORDER BY NOM_FOURN";

			// Préparation de la requete
			$req = $cnx->prepare($sql);

			// Execution de la requete
			$req->execute();

			// On créer une liste d'objet
			$liste = array();

			// Traitement des enregistrements

			while($record = $req->fetch(PDO::FETCH_OBJ)){
				
				$obj = new Fournisseur();

				$obj->setId($record->ID_FOURN);
				$obj->setNom($record->NOM_FOURN);
				$obj->setAdresse($record->ADRESSE_FOURN);
				$obj->setVille($record->VILLE_FOURN);
				$obj->setCP($record->CP_FOURN);
				$obj->setTel($record->TEL_FOURN);
				$obj->setFax($record->FAX_FOURN);
				$obj->setMail($record->MAIL_FOURN);

				$liste[] = $obj;
			}

			return $liste;
		}

		public function getAllFournisseurLimit($cnx,$start,$decal){
			
			$sql = "SELECT * FROM fournisseurs ORDER BY id_fourn LIMIT ?,?";
			$req = $cnx->prepare($sql);

			$req->bindParam(1, $start, PDO::PARAM_INT);
        	$req->bindParam(2, $decal, PDO::PARAM_INT);
			$res = $req->execute();

			$liste = array();

			while($record = $req->fetch(PDO::FETCH_OBJ)){
					$obj = new Fournisseur();

					$obj->setId($record->ID_FOURN);
					$obj->setNom($record->NOM_FOURN);
					$obj->setAdresse($record->ADRESSE_FOURN);
					$obj->setVille($record->VILLE_FOURN);
					$obj->setCP($record->CP_FOURN);
					$obj->setTel($record->TEL_FOURN);
					$obj->setFax($record->FAX_FOURN);
					$obj->setMail($record->MAIL_FOURN);


					$liste[] = $obj;
				}

			return $liste;
		}

		public function getFournisseurById($cnx,$id){

			$sql = 'SELECT * FROM fournisseurs WHERE ID_FOURN=?';
			$req = $cnx->prepare($sql);
			$req->execute(array($id));

			$cat = $req->fetchAll(PDO::FETCH_OBJ);

			$obj = new Fournisseur();

			$obj->setId($record->ID_FOURN);
			$obj->setNom($record->NOM_FOURN);
			$obj->setAdresse($record->ADRESSE_FOURN);
			$obj->setVille($record->VILLE_FOURN);
			$obj->setCP($record->CP_FOURN);
			$obj->setTel($record->TEL_FOURN);
			$obj->setFax($record->FAX_FOURN);
			$obj->setMail($record->MAIL_FOURN);

			return $obj;
		}

		public function getNbFournisseurs($cnx){

			$sql = "SELECT count(*) as 'nb_fourn' FROM fournisseurs";
			$req = $cnx->query($sql)->fetch(PDO::FETCH_OBJ);

			return $req;
		}

		public function getAllProdByFourn($cnx,$start,$decal,$id_fourn){

			$sql = "SELECT * FROM produits WHERE ID_FOURN = ? ORDER BY ID_PROD LIMIT ?,?";
			$req = $cnx->prepare($sql);
			$req->bindParam(1, $id_fourn, PDO::PARAM_INT);
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