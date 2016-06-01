<?php

// Controlleur Spécifique

$fourn = new FournisseurManager();
$pagination = new Pagination();

	switch ($_SESSION['action']) {

		case '1':
		default:
			$pagination->setDecal(18);
			$pagination->setNbPage($fourn->getNbFournisseurs($cnx)->nb_fourn,$pagination->getDecal());

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
			$lstFourn = $fourn->getAllFournisseurLimit($cnx,$pagination->getStart(),$pagination->getDecal());
			require_once("View/fournisseurs.php");
			break;

		case '2':
			$pagination->setDecal(9);
			$pagination->setNbPage($fourn->getNbFournisseurs($cnx)->nb_fourn,$pagination->getDecal());

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
			$lstProdByFourn = $fourn->getAllProdByFourn($cnx,$pagination->getStart(),$pagination->getDecal(),$_GET['id_fourn']);
			require_once("View/produit_by_fourn.php");
			break;	
	}

?>