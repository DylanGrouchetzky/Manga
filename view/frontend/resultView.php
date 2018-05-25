<?php ob_start(); ?>
<?php
while ($data = $category->fetch()){
	?>
	<li><a href="index.php?action=selectCategory&amp;id=<?= $data['ID'] ?>"><?= $data['category'] ?></a></li>
	<?php
} 
?>
<?php $genre = ob_get_clean(); ?>
<?php ob_start(); ?>
<?php
$name = nameCategory($search['category']);
?>
<h1>Voici le manga</h1>
<table>
	<tr>
		<th><a href="index.php?action=tome&amp;id=<?= $search['ID'] ?>"><img src="public/image/<?= $search['picture'] ?>" class="thumbnail"></a></th>
		<th>
			<p>Nom : <?= $search['name']; ?></p>
			<p>Category : <?= $name['category']; ?></p>
		</th>
		</tr>
</table>
<?php $body = ob_get_clean(); ?>
<?php require('view/frontend/template.php') ?>