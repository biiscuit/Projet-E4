<?php 

	$titrePage = "Catégories";
	ob_start();

?>

<table class="table table-bordered">

<?php
	if(count($lstFourn) == 0){
		echo '<td width:100% class="text-center"> Aucun Résultat </td>';
	}
	else{
		echo '<tr>';
		foreach ($lstFourn as $value) {
			$compteur++;
?>
	<td width=33%> 
		<a class="btn btn-link center-block" href="index.php?section=2&action=2&id_fourn=<?= $value->getId()?> " >
			<div class="text-center">
				<p class=""> <u> <?php echo $value->getNom() ?> </u></p>
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
					<a class="btn btn-primary" href="index.php?section=2&page=<?= $i ?>"> <?= $i ?></a>
			<?php
				}
			?>


			
<?php

	$content = ob_get_clean();
	require_once("template.php");

 ?>