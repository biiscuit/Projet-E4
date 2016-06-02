<?php 

	$titrePage = "Mes Factures";
	ob_start();

?>

<div class="container">
	<div class="row">
		<h2 class="text-center">Mes Factures</h2>
	</div>

	<table class="table table-bordered">

		<tr class="text-center">
			<td>Date Facture</td>
			<td>Voiture</td>
			<td>Prix Total TTC</td>
			<td>Payer</td>
		</tr>

	<?php
		if(count($lstFacById) == 0){
			echo '<td width:100% class="text-center" colspan="6"> Aucune facture</td>';
		}
		else{
			foreach ($lstFacById as $value) {
				echo '<tr class="text-center">';
	?>
		<td>
			<a class="btn btn-link center-block" href='index.php?section=3&action=3&num_facture=<?= $value->getNumFacture();?>&payer=<?= $value->getPayer()?>'>
				<p style="margin-bottom:0px"><?= $value->getDateFacture() ?></p>
			</a>
		</td>

		<td>
			<p> <?= $value->getNumImmat() == null ? '' : $value->getNumImmat() ?> </p>
		</td>

		<td>
			<p> <?= $value->getPrixTotal() ?> € </p>
		</td>

		<td>
			<p> <?= $value->getPayer() == 1 ? "Payer" : "<span style='color:red'>Non Payer </span>" ?> </p>
 		</td>
	<?php
			if($compteur % $pagination->getDecal() == 0){
				echo '</tr>';
				echo '<tr>';
			}
			}

		}
	?>

	</table>

		<div class="text-center">

			<?php
				for ($num_page=1; $num_page <= $pagination->getNbPage(); $num_page++) { 
			?>
					<a class="btn btn-primary" href="index.php?section=3&action=2&page=<?= $num_page ?>"> <?= $num_page ?></a>
			<?php
				}
			?>

		</div>

</div>
			
<?php

	$content = ob_get_clean();
	require_once("template.php");

 ?>