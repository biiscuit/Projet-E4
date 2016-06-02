<?php

$prod = new ProduitManager();
$pagination = new Pagination();


switch ($_SESSION['action']) {

		case '1': // Afficher le panier
		default:
			$lstPanier = $_SESSION['panier']->afficherCommande($cnx,$prod);
			require_once("View/mon_panier.php");
			break;

		case '2': // Afficher les factures
			$pagination->setDecal(9);
			$pagination->setNbPage($cat->getNbCategories($cnx)->nb_cat,$pagination->getDecal());

			if(isset($_GET['page'])){
				$pagination->setStart($_GET['page']);
				$pagination->setPageActuelle($_GET['page']);
			}
			else{
				$pagination->setStart(0);
				$pagination->setPageActuelle(1);
			}

			// le compteur d'images par ligne, il commence a 0 , et on fait un modulo dessus pour finir
			$compteur = 0;
			$lstProdByCat = $cat->getAllProdByCat($cnx,$pagination->getStart(),$pagination->getDecal(),$_GET['id_cat']);
			require_once("View/produit_by_cat.php");
			break;

		case '3': // Afficher les RDV et pouvoir prendre un RDV
			break;	
	}