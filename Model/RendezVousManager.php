<?php

class RendezVousManager{

	public function getRdvByIdClient($cnx,$id_client){

		$sql = "SELECT * FROM rdv, clients_demander_rdv cld WHERE `rdv`.`ID_RDV` = `cld`.`ID_RDV` AND `cld`.ID_CLIENT = ?";
		$req = $cnx->prepare($sql);
		$req -> execute(array($id_client));

		$liste = array();

		while($record = $req->fetch(PDO::FETCH_OBJ)){

			$obj = new RendezVous();

			$obj->setIdRdv($record->ID_RDV);
			$obj->setDateDebut($record->DATE_DEBUT);
			$obj->setDateFin($record->DATE_FIN);
			$obj->setDescription($record->DESCRIPTION);

			$liste[] = $obj;
		}

		return $liste;
	}


}