<?php

$pdt = new ProduitManager();
$pagination = new pagination();

if(isset($_POST['inscription']) || isset($_POST['connexion']) || isset($_POST['deconnexion'])){
	require_once("Controler/process_form.php");
}

	switch ($_SESSION['action']) {
		case '1':
		default:
			$pagination->setDecal(9);
			$pagination->setNbPage($pdt->getNbProduits($cnx)->nb_prod,$pagination->getDecal());
			
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
			$lstProd = $pdt->getAllProduitsLimit($cnx,$pagination->getStart(),$pagination->getDecal());
			require_once("View/home.php");
			break;
		
		case '2':
			$produit = $pdt->getProduitById($cnx,$_GET['id_produit']);
			if($produit->getIdProd() == null){
				$msg->addErrorMessage("Produit Incorrect");
				$msg->ShowMessage();

				$pagination->setDecal(9);
				$pagination->setNbPage($pdt->getNbProduits($cnx)->nb_prod,$pagination->getDecal());
				
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
				$lstProd = $pdt->getAllProduitsLimit($cnx,$pagination->getStart(),$pagination->getDecal());
				require_once("View/home.php");
				break;
			}
			else{
				require_once("View/details_produit.php");
				break;
			}
				
	}