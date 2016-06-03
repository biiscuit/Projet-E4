<?php 

	$titrePage = "Mes Rendez-Vous";
	ob_start();

?>

<div class="container">
	<div class="row">
		<h2 class="text-center">Mon Panier</h2>
	</div>

	<table class="table table-bordered">

		<tr class="text-center">
			<td>Date RDV</td>
			<td>Description</td>
		</tr>

	<?php
		if(count($lstRdv) == 0){
			echo '<td width:100% class="text-center" colspan="2"> Aucun Rendez-Vous</td>';
		}
		else{
			foreach ($lstRdv as $value) {
				echo '<tr class="text-center">';
	?>
		<td>
			<p style="width:300px"> <?= "Du " . $value->getDateDebut() . " jusqu'au ". $value->getDateFin(); ?> </p>
		</td>

		<td>
			<p style="word-wrap:break-word;width:780px"> <?= $value->getDescription(); ?></p>
 		</td>

	<?php
			echo '</tr>';
			}

		}
	?>

	</table>
</div>


			
<?php

	$content = ob_get_clean();
	require_once("template.php");

 ?>