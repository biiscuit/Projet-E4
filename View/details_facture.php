<?php 

	$titrePage = "Facture n°" . $_GET['num_facture'];
	ob_start();

?>

<div class="container">
	<div class="row">
		<h2 class="text-center">Mon Panier</h2>
	</div>

	<table class="table table-bordered">

		<tr class="text-center">
			<td>Image Produit</td>
			<td>Designation</td>
			<td>Prix unitaire</td>
			<td>Quantité</td>
			<td>Prix TTC</td>
		</tr>

	<?php
		$total = 0;
		if(count($lstCommande) == 0){
			echo '<td width:100% class="text-center" colspan="6"> Aucun Produit dans le panier</td>';
		}
		else{
			foreach ($lstCommande as $value) {
				echo '<tr class="text-center">';
	?>
		<td> 
			<img width="50px" height="50px" 
				src=<?php if($lstProdFac[$compteur]->getIdProd() == $value->getIdProd()){
							echo $lstProdFac[$compteur]->getImgProd();
							}?> >
		</td>

		<td>
			<a class="btn btn-link center-block" style="text-decoration: none;" 
				href="index.php?section=0&action=2&id_produit=<?= $value->getIdProd()?> " >
				<?php if($lstProdFac[$compteur]->getIdProd() == $value->getIdProd()){
							echo $lstProdFac[$compteur]->getNomProd();
						} ?>
			</a>
		</td>

		<td>
			<p> <?= $value->getPrixProd() . " €" ?> </p>
		</td>

		<td>
			<p> <?= $value->getQuantiteProd()?> </p>
		</td>

		<td>
			<p> <?= $value->getQuantiteProd() * $value->getPrixProd() ?> €</p>
 		</td>
	<?php
			$total = $total + $value->getQuantiteProd() * $value->getPrixProd();
			$compteur++;
			echo '</tr>';
			}

		}

		if($main_oeuvre->getIdMo() != null){
			echo '<tr class="text-center">';
	?>
		<td> <p> Main Oeuvre </p> </td>
		<td>
			<p> <?= $main_oeuvre->getNomMo(); ?> </p>
		</td>
		<td>
			<p> <?= $main_oeuvre->getPrixMo(); ?> € </p>
		</td>

		<td>
			<p> <?= $main_oeuvre->getNbHeuresMo(); ?> </p>
		</td>

		<td>
			<p> <?= $main_oeuvre->getPrixMo() * $main_oeuvre->getNbHeuresMo(); ?> € </p>
		</td>
	<?php
		$total = $total + ($main_oeuvre->getPrixMo() * $main_oeuvre->getNbHeuresMo());
		}
		echo '</tr>';
	?>

		<tr class="text-center">
			<td colspan="4"></td>
			<td>
				<p> TOTAL : <?= $total . " €" ?> </p>
			</td>
		</tr>

	</table>

</div>
			
<?php

	$content = ob_get_clean();
	require_once("template.php");

 ?>