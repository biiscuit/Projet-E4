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

		<tr class="text-center">

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
					$total = ($main_oeuvre->getPrixMo() * $main_oeuvre->getNbHeuresMo());
				?>
		</tr>

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