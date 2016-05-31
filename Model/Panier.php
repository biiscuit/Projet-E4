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

		// Retire la quantité des stocks de la base de données et s'ajoute dans la commande du client
		public function passerCommande(){

		}

		// Affiche les commandes effectuées par le client
		public function afficherCommande($id_client){

		}


	}