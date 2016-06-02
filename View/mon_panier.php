<?php 

	$titrePage = "Mon Panier";
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
			<td>Supprimer</td>
		</tr>

	<?php
		if(count($lstPanier) == 0){
			echo '<td width:100% class="text-center" colspan="6"> Aucun Produit dans le panier</td>';
		}
		else{
			foreach ($lstPanier as $value) {
				echo '<tr class="text-center">';
	?>
		<td> 
			<img width="50px" height="50px" src=<?= $value->getImgProd()?> >
		</td>

		<td>
			<a class="btn btn-link center-block" style="text-decoration: none;" 
				href="index.php?section=0&action=2&id_produit=<?= $value->getIdProd()?> " >
				<?= $value->getNomProd() ?>
			</a>
		</td>

		<td>
			<p> <?= $value->getPrixProd() . " €" ?> </p>
		</td>

		<td>
			<p> <?= $_SESSION['panier']->getQuantite($value->getIdProd()) ?> </p>
		</td>

		<td>
			<p> <?= $_SESSION['panier']->getQuantite($value->getIdProd()) * $value->getPrixProd() . " €" ?></p>
 		</td>

 		<td>
 			<form method="POST">		
				<div class="form-group">
					<input type="hidden" name="id_produit" value=<?= $value->getIdProd() ?>>
					<button type="submit" class="btn btn-danger" aria-label="Left Align" name="supprimer_quantite">
					  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>
				</div>
			</form>
 		</td>
	<?php
			echo '</tr>';
			}

		}
		if($_SESSION['panier']->getTotalPanier() != 0){
	?>

		<tr class="text-center">
			<td colspan="5"></td>
			<td>
				<p> TOTAL : <?= $_SESSION['panier']->getTotalPanier() . " €" ?> </p>
			</td>
		</tr>
	<?php 
		}
	?>

	</table>

	<?php
		if(count($lstPanier) != 0){
	?>
	<form method="POST" class="text-center">		
		<div class="form-group">
			<button type="submit" class="btn btn-success" aria-label="Left Align" name="confirmer_panier">
				<p style="margin-bottom:0px">Confirmer ma commande <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></p>
			</button>
		</div>
	</form>
		<?php
			}
		?>

</div>


			
<?php

	$content = ob_get_clean();
	require_once("template.php");

 ?>