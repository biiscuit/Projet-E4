<?php

// Controlleur Spécifique

$cat = new CategorieManager();
$pagination = new Pagination();

	switch ($_SESSION['action']) {

		case '1':
		default:
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

		case '2':
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
	}

?>