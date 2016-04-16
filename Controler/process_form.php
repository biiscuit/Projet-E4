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
		$usr->inscrireClient($_POST);
		break;

	case 2:
		unset($_SESSION['id_client']);
		header('index.php?section=1');
		break;
}

?>