<?php 

	$titrePage = "Catégories";
	ob_start();

?>

<table class="table table-bordered">

<?php
	if(count($lstCat) == 0){
		echo '<td width:100% class="text-center"> Aucun Résultat </td>';
	}
	else{
		echo '<tr>';
		foreach ($lstCat as $value) {
			$compteur++;
?>
	<td width=33%> 
				<!-- href="index.php?page=details_produit&id_produit=<?php //$value['id_produit']?><!-- " -->
		<a class="btn btn-link center-block" >
			<div class="text-center">
				<p class=""> <u> <?php echo $value->getLibelle() ?> </u></p>
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
					<a class="btn btn-primary" href="index.php?section=1&page=<?= $i ?>"> <?= $i ?></a>
			<?php
				}
			?>


			
<?php

	$content = ob_get_clean();
	require_once("template.php");

 ?>