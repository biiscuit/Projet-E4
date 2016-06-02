<?php

$prod = new ProduitManager();
$mo = new MainOeuvreFactureManager();
$fac = new FactureManager();
$pagination = new Pagination();


switch ($_SESSION['action']) {

		case '1': // Afficher le panier
		default:
			$lstPanier = $_SESSION['panier']->afficherCommande($cnx,$prod);
			require_once("View/mon_panier.php");
			break;

		case '2': // Afficher les factures
			$pagination->setDecal(9);
			$pagination->setNbPage($fac->getNbFactures($cnx,$_SESSION['id_client'])->nb_facture,$pagination->getDecal());

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
			$lstFacById = $fac->getFactureById($cnx,$pagination->getStart(),$pagination->getDecal(),$_SESSION['id_client']);
			require_once("View/facture_by_client.php");
			break;

		case '3': // Afficher le contenu d'une facture
			$lstCommande = $_SESSION['panier']->afficherDetailsFacture($cnx,$_GET['num_facture'],$_SESSION['id_client']);
			//var_dump($lstCommande);
			// On récupère la Main d'Oeuvre s'il y en a une et obtient le numéro ID du client
			$main_oeuvre = $mo->getMOByNumFacture($cnx,$_GET['num_facture']);

			// On vérifie que l'utilisateur ne change pas la variable du get
			if($lstCommande == true){
				foreach ($lstCommande as $key => $value) {
					$lstIdProd[] = array(
								'id_prod' => $value->getIdProd()
								);
				}
				$compteur = 0;
				$lstProdFac = $prod->getProduitInListe($cnx,$lstIdProd);
		
				require_once("View/details_facture.php");
				break;
			}
			elseif($lstCommande == false && $main_oeuvre->getNomMo() != null && $main_oeuvre->getIdClient() == $_SESSION['id_client']){
				// On affiche cette page si la liste commande est fausse et qu'il y a une main d'oeuvre dans la facture
				require_once("View/details_facture2.php");
				break;
			}
			else{
				header("Location:index.php?section=0");
				break;
			}
			break;

		case '4': // Afficher les RDV et pouvoir prendre un RDV
			break;	
	}