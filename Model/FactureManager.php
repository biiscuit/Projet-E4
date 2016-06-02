<?php

class FactureManager{

	private $num_facture;
	private $num_immat;
	private $id_client;
	private $date_facture;
	private $prix_total;
	private $payer;

	public function getAllFactures($cnx){

		$sql = "SELECT * FROM Factures ORDER BY NUM_FACTURE";
		$req = $cnx->prepare($sql);
		$res = $req->execute();

		$liste = array();

		while($record = $req->fetch(PDO::FETCH_OBJ)){
				$obj = new Facture();

				$obj->setNumFacture($record->NUM_FACTURE);
				$obj->setNumImmat($record->NUM_IMMAT);
				$obj->setIdClient($record->ID_CLIENT);
				$obj->setDateFacture($record->DATE_FACTURE);
				$obj->setPrixTotal($record->PRIX_TOTAL);
				$obj->setPayer($record->PAYER);

				$liste[] = $obj;
			}

			return $liste;
	}

	public function getAllFacturesLimit($cnx,$start,$decal){
		
		$sql = "SELECT * FROM Factures ORDER BY NUM_FACTURE LIMIT ?,?";
		$req = $cnx->prepare($sql);
		$req->bindParam(1, $start, PDO::PARAM_INT);
        $req->bindParam(2, $decal, PDO::PARAM_INT);
        $req->execute();

		$liste = array();

		while($record = $req->fetch(PDO::FETCH_OBJ)){
				$obj = new Facture();

				$obj->setNumFacture($record->NUM_FACTURE);
				$obj->setNumImmat($record->NUM_IMMAT);
				$obj->setIdClient($record->ID_CLIENT);
				$obj->setDateFacture($record->DATE_FACTURE);
				$obj->setPrixTotal($record->PRIX_TOTAL);
				$obj->setPayer($record->PAYER);

				$liste[] = $obj;
			}

		return $liste;
	}

	public function getNbFactures($cnx,$id_client){

		$sql = "SELECT count(*) as 'nb_facture' FROM Factures WHERE ID_CLIENT = ?";
		$req = $cnx->prepare($sql);
		$req->execute(array($id_client));
		$req = $req->fetch(PDO::FETCH_OBJ);

		return $req;
	}

	public function getFactureById($cnx,$start,$decal,$id_client){

		$sql = "SELECT * FROM Factures WHERE ID_CLIENT = ? ORDER BY NUM_FACTURE LIMIT ?,?";
		$req = $cnx->prepare($sql);
		$req->bindParam(1, $id_client, PDO::PARAM_INT);
		$req->bindParam(2, $start, PDO::PARAM_INT);
        $req->bindParam(3, $decal, PDO::PARAM_INT);
        $req->execute();

		$liste = array();

		
		while($record = $req->fetch(PDO::FETCH_OBJ)){
				$obj = new Facture();

				$obj->setNumFacture($record->NUM_FACTURE);
				$obj->setNumImmat($record->NUM_IMMAT);
				$obj->setIdClient($record->ID_CLIENT);
				$obj->setDateFacture($record->DATE_FACTURE);
				$obj->setPrixTotal($record->PRIX_TOTAL);
				$obj->setPayer($record->PAYER);

				$liste[] = $obj;
			}

		return $liste;
	}
}