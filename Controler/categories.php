<?php

// Controlleur Spécifique

$mng = new CategorieManager();

	switch ($_SESSION['action']) {

		case 'listing':
			$liste = $mng->getAllCategorie($cnx);
			require_once("View/categories.php");
			break;

		case 'modification':
			$cat = $mng->getCategorieById($cnx,$_GET['id']);
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