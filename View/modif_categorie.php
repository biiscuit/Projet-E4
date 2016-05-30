<?php 

	$titrePage = "Modification - Catégorie";
	ob_start();
?>

	<div class="col-md-12 col-md-offset-3">
		<form class="form-inline" role="form" method="POST">
		  <div class="form-group">
		    <label for="inputLibelle">Libellé :</label>
		    <input type="text" class="form-control" name ="inputLibelle" id="inputLibelle" value="<?php echo $cat->getLibelle();?>">
		  </div>
		  <button type="submit" name="modif_cat" class="btn btn-default">Sauvegarder</button>
		</form>
	</div>

<?php

	$content = ob_get_clean();
	require_once("template.php");
 ?>