<?php 

	$titrePage = "Catégorie";
	ob_start();
?>

<table class="table">
 
 <!-- FAIRE UN TABLEAU AVEC LES CATS ET UNE IMAGE -->
	<th>Libellé</th>
	<th>mod</th>
	<th>sup</th>

<?php
	foreach ($liste as $value) {
?>
	<tr>
		<td><?php echo $value->getLibelle();?></td>
		<td><a href="index.php?id=<?php echo $value->getIdCategorie();?>&section=<?php echo $section?>&action=modification">modifier</a></td>
		<td><a href="index.php?id=<?php echo $value->getIdCategorie();?>&section=<?php echo $section?>&action=suppression">supprimer</a></td>
	</tr>
<?php 
}
?>
</table>

	<p> Le HTML du contenu principal de la catégorie est ici </p>

<?php

	$content = ob_get_clean();
	require_once("template.php");

 ?>