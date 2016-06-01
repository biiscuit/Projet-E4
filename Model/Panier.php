<?php

	class Panier{

		private $total_panier = 0;
		private $liste_id_items = array();


		public function setTotalPanier($prix,$qte,$signe){
			if($signe == "add"){
				$this->total_panier = $this->total_panier + $prix*$qte;
			}
			else{
				$this->total_panier = $this->total_panier - $prix*$qte;
			}
		}

		public function getTotalPanier(){
			return $this->total_panier;
		}

		public function ajouterId($cnx,$id,$qte){
			// On ajoute l'id s'il n'existe pas dans le tableau
			if(array_search($id, array_column($this->liste_id_items,'id_prod')) === false){
				$this->liste_id_items[] = array(
					'id_prod' => $id,
					'qte' => $qte
				);

			$sql = "SELECT prix_prod FROM produits WHERE ID_PROD = ?";
			$req = $cnx->prepare($sql);
			$req->execute(array($id));
			$prix = $req->fetch(PDO::FETCH_OBJ);

			$this->setTotalPanier($prix->prix_prod,$qte,"add");
				return true;
			}
			else{
				return false;
			}
		}

		public function supprimerId($cnx,$id){
			// array_search($id, $this->liste_id_items)] renvoi la clé de l'id sinon renvoi false
			// unset($tab[clé]) permet de supprimer un élément d'un tableau
			$cle = array_search($id, array_column($this->liste_id_items,'id_prod'));
			// cle renvoi false s'il ne trouve aucune correspondance
			if($cle != false){
				//On récupère la quantité du produit à supprimer
				$qte = $this->liste_id_items[$cle]['qte'];
				unset($this->liste_id_items[$cle]);
				// Réorganise les clé pour commencer à 0
				array_splice($this->liste_id_items, 0, 0);

				$sql = "SELECT prix_prod FROM produits WHERE ID_PROD = ?";
				$req = $cnx->prepare($sql);
				$req->execute(array($id));
				$prix = $req->fetch(PDO::FETCH_OBJ);

				$this->setTotalPanier($prix->prix_prod,$qte,"red");
				return true;
			}
			else{
				return false;
			}
		}

		public function getListeId(){
			return $this->liste_id_items;
		}

		public function passerCommande($cnx){

			// Création de la facture dans la table facture
			$sql = "INSERT INTO factures VALUES (null,null,?,?,?,'1')";
			$req = $cnx->prepare($sql);
			$req->execute(array($_SESSION['id_client'],date("Y-m-d"),$this->getTotalPanier()));

			// On récupère l'ID de la facture créer
			$sql = "SELECT max(NUM_FACTURE) as num_facture FROM factures";
			$num_facture = $cnx->query($sql);
			$num_facture = $num_facture->fetch(PDO::FETCH_OBJ);

			// Création du détails dans la facture dans factures_composer_produits
			$sql = "INSERT INTO factures_composer_produits VALUES (?,?,?,?)";
			$req = $cnx->prepare($sql);
			foreach ($this->getListeId() as $key => $value) {
				
				// On récupère le prix actuelle du produit
				$sql2 = "SELECT prix_prod as prix FROM produits WHERE ID_PROD = ?";
				$prix_prod = $cnx->prepare($sql2);
				$prix_prod->execute(array($value['id_prod']));
				$prix_prod = $prix_prod->fetch(PDO::FETCH_OBJ);

				// On execute la requet d'ajout dans factures_composer_produits
				$req->execute(array($num_facture->num_facture,$value['id_prod'],$value['qte'],$prix_prod->prix));
			}

		}

		public function afficherCommande($cnx){

			$sql = "SELECT * FROM factures WHERE ID_CLIENT = ?";
			$req = $cnx->prepare($sql);
			$req->execute(array($_SESSION['id_client']));

			$liste = array();

			while($record = $req->fetch(PDO::FETCH_OBJ)){
				$obj = new Facture();

				$obj->setNumFacture($record->NUM_FACTURE);
				$obj->setNumImmat($record->NUM_IMMAT);
				$obj->setIdClient($record->ID_CLIENT);
				$obj->setDateFacture($record->DATE_FACTURE);
				$obj->setPrixTotal($record->PRIX_TOTAL);
				$obj->setPayer($record->PAYER);

				$liste[] = $obj;

			}

			return $liste;

		}

		public function afficherDetailsCommande($cnx,$num_facture){

			$sql = "SELECT * FROM factures_composer_produits WHERE NUM_FACTURE = ?";
			$req = $cnx->prepare($sql);
			$req->execute(array($num_facture));

			$liste = array();

			while($record = $req->fetch(PDO::FETCH_OBJ)){
				$obj = new FactureComposerProduit();

				$obj->setNumFacture($record->NUM_FACTURE);
				$obj->setIdProd($record->ID_PROD);
				$obj->setQuantiteProd($record->QUANTITE_PROD);
				$obj->setPrixProd($record->PRIX_EFFECTIF_PROD);

				$liste[] = $obj;

			}

			return $liste;

		}


	}