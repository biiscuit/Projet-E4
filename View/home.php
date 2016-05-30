<?php 

	$titrePage = "Accueil";
	$pdt = new ProduitManager();
	ob_start();

	// $start = id du produit que l'on commence à afficher, et $nb_show = nombre de produits qu'on affiche sur une page
	if(!isset($_GET['page']) || $_GET['page'] == 1){
		$start = 0;
	}
	else{
		$start = ($_GET['page']-1)*9;
	}
	
	$nb_show = 9;
	// le compteur d'images par ligne, il commence a 0 , et on fait un modulo dessus pour finir
	$compteur = 0;
	$lstProd = $pdt->getAllProduitsByLimit($cnx,$start,$nb_show);

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

<?php
				$nb_produits = $pdt->getNbProduits($cnx);
				$nb_page = ceil(($nb_produits->nb_prod/9));
			?>

			<div class="text-center">

			<?php
				for ($i=1; $i <= $nb_page; $i++) { 
			?>
					<a class="btn btn-primary" href="index.php?section=0&page=<?= $i ?>"> <?= $i ?></a>
			<?php
				}
			?>


			
<?php

	$content = ob_get_clean();
	require_once("template.php");

 ?>