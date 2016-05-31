<?php 

	$titrePage = "Accueil";
	$pdt = new ProduitManager();
	$pagination = new Pagination();
	ob_start();

	$pagination->setDecal(9);
	$pagination->setNbPage($pdt->getNbProduits($cnx)->nb_prod,$pagination->getDecal());

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
	$lstProd = $pdt->getAllProduitsLimit($cnx,$pagination->getStart(),$pagination->getDecal());

?>

<table class="table table-bordered">

<?php
	if(count($lstProd) == 0){
		echo '<td width:100% class="text-center"> Aucun Résultat </td>';
	}
	else{
		echo '<tr>';
		foreach ($lstProd as $value) {
			$compteur++;
?>
	<td width=33%> 
				<!-- href="index.php?page=details_produit&id_produit=<?php //$value['id_produit']?><!-- " -->
		<a class="btn btn-link center-block" >
			<div class="text-center">
				<img style="height:120px" src='<?= $value->getImgProd(); ?>'>
				<p class=""> <u> <?php echo $value->getNomProd() ?> </u></p>
				<p class="" style="margin-bottom:0px"> <?php echo $value->getPrixProd(). " €" ?> </p>
			</div>
		</a>
	</td>
<?php
			if($compteur % 3 == 0){
				echo '</tr>';
				echo '<tr>';
			}
		}
	}
?>

</table>

			<div class="text-center">

			<?php
				for ($i=1; $i <= $pagination->getNbPage(); $i++) { 
			?>
					<a class="btn btn-primary" href="index.php?section=0&page=<?= $i ?>"> <?= $i ?></a>
			<?php
				}
			?>


			
<?php

	$content = ob_get_clean();
	require_once("template.php");

 ?>