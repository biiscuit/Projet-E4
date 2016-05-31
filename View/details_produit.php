 <?php 

	$titrePage = $produit->getNomProd();
	ob_start();

?>

<table class="table table-bordered">
	<tr class="text-center">
		<td width="50%">
			<img class="img-responsive center-block" width="350px" src="<?= $produit->getImgProd(); ?>">
			<div style="margin-top:30px"> <u> <?php echo $produit->getNomProd() ?> </u></div>
		</td>

		<td width=50%>
			<table class="descr_prod" style="margin:auto;margin-top:8%">
				<tr height="10px">
					<td style="text-align:left">Référence: </td>
					<td style="text-align:left;padding-left:50px"> <?= $produit->getIdProd() ?> </td>
				</tr> 

				<tr>
					<td style="text-align:left">Prix: </td>
					<td style="text-align:left;padding-left:50px"> <?= $produit->getPrixProd(). " €" ?> </td>
				</tr>
				<tr>
					<td style="text-align:left">Stock: </td>
					<?php
						if($produit->getStockProd() != 0){
							echo "<td style='text-align:left;padding-left:50px'> {$produit->getStockProd()} </td>";
						}
						else{
							echo "<td style='text-align:left;padding-left:50px;color:#FF0000'> Plus disponible en stock </td>";
						} 
					?>

				</tr>

				<tr>
					<td style="text-align:left">Description: </td>
					<td style="text-align:left;padding-left:50px"> <?= (empty($produit->getDescription())) ? 'Aucune Description ' : $produit->getDescription() ?> </td>
				</tr>

				</table>

				<?php
					if($produit->getStockProd() != 0){
				?>

				<form style="margin-top:10%" method="POST">
						<div class="form-group"> 
							<label for ="quantite"> Quantité </label>
							<input type ="number" id="quantite" value="1" max="<?= $produit->getStockProd()?>" name="quantite"/> 
						</div>
				
						<div class="form-group">
							<input type="hidden" name="qte_stock" value=<?= $produit->getStockProd() ?> >
							<input type="hidden" name="id_produit" value=<?= $produit->getIdProd() ?> >
							<input class="btn btn-success" name="ajout_quantite" type="submit" value ="Ajout au panier">
						</div>
				</form>
				<?php
				   }
				   else{
				?>
						<div class="form-group" style="margin-top:30%">
							<a href="index.php?section=0"> Retour à l'accueil </a>
						</div>
				<?php
				   }
				?>
				
		</td>

	</tr>
</table>

			
<?php

	$content = ob_get_clean();
	require_once("template.php");

 ?>

