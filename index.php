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
$msg = new Message();

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

// DONNEES POST ET TEST FORMULAIRES



?>