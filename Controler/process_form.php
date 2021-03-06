<?php 

//var_dump($_POST);

if(isset($_POST['connexion'])){
	$form_action = 0;
}

if(isset($_POST['inscription'])){
	$form_action = 1;
}

if(isset($_POST['deconnexion'])){
	$form_action = 2;
}

if(isset($_POST['ajout_quantite'])){
	$form_action = 3;
}

if(isset($_POST['supprimer_quantite'])){
	$form_action = 4;
}

if(isset($_POST['confirmer_panier'])){
	$form_action = 5;
}

if(isset($_POST['annuler_panier'])){
	$form_action = 6;
}

$usr = new User();

switch ($form_action) {
	case 0:
		if($usr->seConnecter($cnx,$_POST['inputEmail'],$_POST['inputPassword']) == true){
			$_SESSION['id_client'] = $usr->getId();
			$msg->addSuccessMessage("Vous êtes bien connecté.");
		}
		else{
			$msg->addErrorMessage("Erreur lors de la connexion");
		}
		$msg->ShowMessage();
		//require_once('Controler/produits.php');
		break;
	
	case 1:
		// Si le numéro de téléphone ne correspond pas à l'expression régulière alors message d'erreur
		if(!preg_match('/^[0-9]{2}([\. -]?[0-9]{2}){4}$/',$_POST['inputTel'])){
			$msg->addErrorMessage("Mauvais numéro de téléphone.");
		}

		// Si le code postal ne correspond pas à l'expression régulière alors message d'erreur
		if(!preg_match('/^[0-9]{5}$/',$_POST['inputCP'])){
			$msg->addErrorMessage("Mauvais Code Postal.");
		}

		// Si les 2 mots de passes sont différents alors message d'erreur
		if($_POST['inputPassword'] != $_POST['inputPassword2']){
			$msg->addErrorMessage("Les deux mots de passes sont différents.");
		}

		if($msg->messageErrorExists() == false){
			
			if($usr->inscrireClient($cnx,$_POST) == true){
				$msg->addSuccessMessage("L'inscription s'est bien effectué.");
			}
			else{
				$msg->addErrorMessage("Erreur lors de l'inscription.");
			}
			$msg->ShowMessage();
		}
		else{
			$msg->ShowMessage();
		}
		break;

	case 2:
		unset($_SESSION['id_client']);
		session_destroy();
		$msg->addSuccessMessage("Vous êtes bien déconnecté.");
		$msg->ShowMessage();
		break;

	case 3:
		if(isset($_SESSION['id_client'])){
			$_SESSION['panier']->ajouterId($cnx,$_POST['id_produit'],$_POST['quantite']);
			$msg->addSuccessMessage("Produit ajouté au panier.");
			$msg->ShowMessage();	
		}
		else{
			$msg->addErrorMessage("Vous devez être connecté.");
			$msg->ShowMessage();
		}
		break;

	case 4:
		if($_SESSION['panier']->supprimerId($cnx,$_POST['id_produit']) == true){
			$msg->addSuccessMessage("Produit supprimé du panier.");
			$msg->ShowMessage();
		}
		else{
			$msg->addErrorMessage("Erreur lors de la suppression.");
			$msg->ShowMessage();
		}
		break;

	case 5:
		if($_SESSION['panier']->passerCommande($cnx) == true){
			$msg->addSuccessMessage("Commande effectué.");
			$msg->ShowMessage();
		}
		else{
			$msg->addErrorMessage("Erreur lors de la commande.");
			$msg->ShowMessage();
		}
		break;

	case 6:
		$_SESSION['panier']->viderPanier();
			$msg->addSuccessMessage("Suppression du panier effectué.");
			$msg->ShowMessage();
		break;
}

?>