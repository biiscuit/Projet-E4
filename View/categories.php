<?php 

	$titrePage = "Catégorie";
	ob_start();
?>

<table class="table">
	<th>N°</th>
	<th>Libellé</th>
	<th>mod</th>
	<th>sup</th>

<?php
	$cat = new CategorieManager();
	$liste = $cat->getAllCategorie($cnx);
	foreach ($liste as $value) {
?>
	<tr>
		<td><?php echo $value->getIdCategorie();?></td>
		<td><?php echo $value->getLibelle();?></td>
		<td><a href="index.php?id=<?php echo $value->getIdCategorie();?>&section=<?php echo $section?>&action=modification">modifier</a></td>
		<td><a href="index.php?id=<?php echo $value->getIdCategorie();?>&section=<?php echo $section?>&action=suppression">supprimer</a></td>
	</tr>
<?php 
}
?>
</table>

<?php

	$content = ob_get_clean();
	require_once("template.php");

 ?>