<?php 

	$titrePage = "Accueil";
	ob_start();

	// Si on vient de se connecter on affiche un message
	// <div class='alert alert-success'> Vous êtes bien connecté</div>

	// Si on vient de se déconnecter on affiche un message
	// <div class='alert alert-success'> Vous êtes bien déconnecté</div>
/*
	Exemple :

	if(!empty($_SESSION['message']['success'])){
			echo "<div class='alert alert-success'>" .implode('<br>',$_SESSION['message']['success']). "</div>";
			unset($_SESSION['message']['success']);
		}*/
?>

	<p> Le HTML du contenu principal de la home est ici </p>

<?php

	$content = ob_get_clean();
	require_once("template.php");

 ?>