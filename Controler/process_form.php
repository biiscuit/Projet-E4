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

$usr = new User();

switch ($form_action) {
	case 0:
		if($usr->seConnecter($cnx,$_POST['inputEmail'],$_POST['inputPassword']) == true){
			$_SESSION['id_client'] = $usr->getId();
		}
		require_once('View/home.php');
		break;
	
	case 1:
		/*if($usr->inscrireClient($_POST) == true){
			// Message flash inscription bien effectué
		}*/

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
		header('index.php?section=1');
		break;
}

?>