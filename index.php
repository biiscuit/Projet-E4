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
$msg = new Message();

if(isset($_GET['action'])){
	$_SESSION['action'] = $_GET['action'];
}

// CONNEXION BDD
$db = new Database();
$cnx = $db->connect();

// RECUPERE GET DE L'URL

$section = 0;


// DIFFERENTES PAGES DU SITE
if(isset($_GET['section'])){

	$section = $_GET['section'];

	switch ($section) {
		case '0':
			require_once("View/home.php");
			break;

		case '1':
			require_once("Controler/categories.php");
			break;

		case '2':
			require_once("Controler/fournisseurs.php");
			break;
	}
}
else {
	require_once("View/home.php");
}

// LES DONNEES POST ET ENVOI VERS PROCESS

if(isset($_POST['modif_cat'])){
	require_once("Controler/process_cat.php");
}

if(isset($_POST['inscription']) || isset($_POST['connexion']) || isset($_POST['deconnexion'])){
	require_once("Controler/process_inscription.php");
}

?>