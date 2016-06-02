<?php 

	class MainOeuvreFactureManager{

		private $numFacture;
		private $idMo;
		private $nbHeuresMo;
		private $prixMo;

		public function getMOByNumFacture($cnx,$num){

			$sql = "SELECT * FROM main_oeuvre_apparaitre_factures WHERE NUM_FACTURE = ?";
			$req = $cnx->prepare($sql);
			$req->execute(array($num));

			$obj = new MainOeuvreFacture();
			while($record = $req->fetch(PDO::FETCH_OBJ)){

				$obj->setNumFacture($record->NUM_FACTURE);
				$obj->setIdMo($record->ID_MO);
				$obj->setNbHeuresMo($record->NB_HEURES_MO);
				$obj->setPrixMo($record->PRIX_EFFECTIF_MO);
				$obj->setNomMo($cnx,$record->ID_MO);
				$obj->setIdClient($cnx,$record->NUM_FACTURE);
			}

			return $obj;

		}

	}

?>