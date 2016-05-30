<?php

$cat = new CategorieManager();
$msg = new Message();

$ancien_nom = $cat->getCategorieById($cnx,$_GET['id'])->getLibelle();


	if($ancien_nom != $_POST['inputLibelle']){
		if($cat->setLibelleById($cnx,$_GET['id'],$_POST['inputLibelle']) == true){
			$msg->addSuccessMessage("Nom de la catégorie Modifié.");
		}
		else{
			$msg->addErrorMessage("Erreur lors de la modification.");
		}
		$msg->ShowMessage();
		
	}