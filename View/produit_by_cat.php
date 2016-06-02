<?php 

	$titrePage = "Accueil";
	ob_start();

?>

<table class="table table-bordered">

<?php
	if(count($lstProdByCat) == 0){
		echo '<td width:100% class="text-center"> Aucun Résultat </td>';
	}
	else{
		echo '<tr>';
		foreach ($lstProdByCat as $value) {
			$compteur++;
?>
	<td width=33%> 
		<a class="btn btn-link center-block" href='index.php?section=0&action=2&id_produit=<?= $value->getIdProd();?>'>
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
				for ($num_page=1; $num_page <= $pagination->getNbPage(); $num_page++) { 
			?>
					<a class="btn btn-primary" href="index.php?section=1&action=2&id_cat=<?= $value->getIdCat() ?>&page=<?= $num_page ?>"> <?= $num_page ?></a>
			<?php
				}
			?>

			</div>


			
<?php

	$content = ob_get_clean();
	require_once("template.php");

 ?>