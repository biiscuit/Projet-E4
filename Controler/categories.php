<?php

// Controlleur Spécifique

$cat = new CategorieManager();
$pagination = new Pagination();

	switch ($_SESSION['action']) {

		case 'listing':
			$pagination->setDecal(18);
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
			$lstCat = $cat->getAllCategorieLimit($cnx,$pagination->getStart(),$pagination->getDecal());
			require_once("View/categories.php");
			break;

		case 'modification':
			$cat = $mng->getCategorieById($cnx,$id);
			require_once("View/modif_categorie.php");
			break;

		case 'process_modification':

			// on récupere les données du formulaire 
			// 1 méthode capable de modifier la base

			//Soit header soit require_once 
			require_once("index.php?section=1&action=listing");

			break;	
	}

?>