<?php 

	$titrePage = "Catégories";
	$cat = new CategorieManager();
	$pagination = new Pagination();
	ob_start();

	$pagination->setDecal(18);
	$pagination->setNbPage($cat->getNbCategories($cnx)->nb_cat,$pagination->getDecal());

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
	$lstCat = $cat->getAllCategorieLimit($cnx,$pagination->getStart(),$pagination->getDecal());

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