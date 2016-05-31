<?php

// Controlleur Principal

//var_dump($_POST);

// Autloader
function monAutoloader($class){
	include_once('Model/' . $class . '.php');
}
spl_autoload_register('monAutoloader');

// CONTROLE DE SESSION
session_start();
$_SESSION['action'] = "listing";
//var_dump($_SESSION);

// CONNEXION BDD
$db = new Database();
$cnx = $db->connect();

// INSTANCIATION DES CLASSES
$msg = new Message();
$pdt = new ProduitManager();
$cat = new CategorieManager();
$pagination = new Pagination();

// RECUPERE GET DE L'URL

$section = 0;

if(isset($_GET['action'])){
	$_SESSION['action'] = $_GET['action'];
}

if(isset($_POST['inscription']) || isset($_POST['connexion']) || isset($_POST['deconnexion'])){
	require_once("Controler/process_form.php");
}

if(isset($_GET['section'])){

	$section = $_GET['section'];

	switch ($section) {
		case '0':
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

		case '1':
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
			require_once("Controler/categories.php");
			break;

		case '2':
			require_once("Controler/fournisseurs.php");
			break;
	}
}
else {
	//Affichage des produits comme le cas section = 0
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
}

// DONNEES POST ET TEST FORMULAIRES



?>