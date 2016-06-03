<?php

	class Panier{

		private $total_panier = 0;
		private $liste_id_items = array();


		public function setTotalPanier($prix,$qte,$signe){
			if($signe == "+"){
				$this->total_panier = $this->total_panier + $prix*$qte;
			}
			else{
				$this->total_panier = $this->total_panier - $prix*$qte;
			}
		}

		public function getQuantite($id){

			foreach ($this->liste_id_items as $key => $value) {
				if($value['id_prod'] == $id){
					return $value['qte'];
				}
			}
		}

		public function getTotalPanier(){
			return $this->total_panier;
		}

		public function ajouterId($cnx,$id,$qte){

			//$bool_ajt renvoi soit un booléen faux si la clé n'existe pas , soit renvoi la clé si elle existe dans le tableau
			$bool_ajt = array_search($id, array_column($this->liste_id_items,'id_prod'));

			$sql = "SELECT prix_prod FROM produits WHERE ID_PROD = ?";
			$req = $cnx->prepare($sql);
			$req->execute(array($id));
			$prix = $req->fetch(PDO::FETCH_OBJ);

			// On ajoute l'id s'il n'existe pas dans le tableau
			if( $bool_ajt === false){
				$this->liste_id_items[] = array(
					'id_prod' => $id,
					'qte' => $qte
				);

				$this->setTotalPanier($prix->prix_prod,$qte,"+");
				return true;
			}
			// On remplace la case par la nouvelle valeur
			elseif(is_numeric($bool_ajt)){

				$old_qte = $this->liste_id_items[$bool_ajt]['qte'];

				$this->liste_id_items[$bool_ajt] = array(
					'id_prod' => $id,
					'qte' => $qte
				);

				if($old_qte - $qte > 0){
					$this->setTotalPanier($prix->prix_prod,($old_qte-$qte),"-");
				}
				elseif($old_qte - $qte < 0){
					$this->setTotalPanier($prix->prix_prod,-($old_qte-$qte),"+");
				}
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
			if(is_numeric($cle)){
				//On récupère la quantité du produit à supprimer
				$qte = $this->liste_id_items[$cle]['qte'];
				unset($this->liste_id_items[$cle]);
				// Réorganise les clé pour commencer à 0
				array_splice($this->liste_id_items, 0, 0);

				$sql = "SELECT prix_prod FROM produits WHERE ID_PROD = ?";
				$req = $cnx->prepare($sql);
				$req->execute(array($id));
				$prix = $req->fetch(PDO::FETCH_OBJ);

				$this->setTotalPanier($prix->prix_prod,$qte,"-");
				return true;
			}
			else{
				return false;
			}
		}

		public function getListeId(){
			return $this->liste_id_items;
		}

		public function viderPanier(){
			$this->liste_id_items = array();
			$this->total_panier =0;
		}

		// Affiche les produits sélectionnés avant de confirmer l'achat
		public function afficherCommande($cnx,$mng){ 

			return $mng->getProduitInListe($cnx,$this->liste_id_items);

		}

		public function passerCommande($cnx){

			// Création de la facture dans la table facture
			$sql_fac = "INSERT INTO factures VALUES (null,null,?,?,'0','1')";
			$req_fac = $cnx->prepare($sql_fac);
			$req_fac->execute(array($_SESSION['id_client'],date("Y-m-d")));

			// On récupère l'ID de la facture créer
			$sql_num = "SELECT max(NUM_FACTURE) as num_facture FROM factures";
			$num_facture = $cnx->query($sql_num);
			$num_facture = $num_facture->fetch(PDO::FETCH_OBJ);

			// Création du détails dans la facture dans factures_composer_produits
			$sql_fcp = "INSERT INTO factures_composer_produits VALUES (?,?,?,?)";
			$req_fcp = $cnx->prepare($sql_fcp);

			foreach ($this->getListeId() as $key => $value) {
				
				// On récupère le prix actuelle du produit
				$sql_prix = "SELECT prix_prod as prix FROM produits WHERE ID_PROD = ?";
				$prix_prod = $cnx->prepare($sql_prix);
				$prix_prod->execute(array($value['id_prod']));
				$prix_prod = $prix_prod->fetch(PDO::FETCH_OBJ);

				// On execute la requet d'ajout dans factures_composer_produits
				$req_fcp->execute(array($num_facture->num_facture,$value['id_prod'],$value['qte'],$prix_prod->prix));
			}
			if($req_fac == true){
				$this->viderPanier();
				return true;
			}
			else{
				return false;
			}
		}

		// Affiche la facture donc une fois la commande passer et le tout payé
		public function afficherFacture($cnx){

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

		public function afficherDetailsFacture($cnx,$num_facture,$id_client){

			$sql = "SELECT * FROM factures_composer_produits fcp, factures f WHERE `f`.`ID_CLIENT` = ? AND `fcp`.`NUM_FACTURE` = `f`.`NUM_FACTURE` AND `f`.`NUM_FACTURE` = ?";
			$req = $cnx->prepare($sql);
			$req->execute(array($id_client,$num_facture));

			$liste = array();

			while($record = $req->fetch(PDO::FETCH_OBJ)){
				$obj = new FactureComposerProduit();

				$obj->setNumFacture($record->NUM_FACTURE);
				$obj->setIdProd($record->ID_PROD);
				$obj->setQuantiteProd($record->QUANTITE_PROD);
				$obj->setPrixProd($record->PRIX_EFFECTIF_PROD);

				$liste[] = $obj;

			}

			if(empty($liste)){
				return false;
			}
			else{
				return $liste;
			}
		}


	}