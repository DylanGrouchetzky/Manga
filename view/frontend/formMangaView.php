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
<h1>Ajouté un Manga</h1>
<form action="index.php?action=addManga" method="post">
	<table>
		<tr>
			<th><label for="name">Nom du manga :</label></th>
			<th><input type="text" name="name" id="name"></th>
		</tr>
		<tr>
			<th><label for="picture">Image :</label></th>
			<th><input type="text" name="picture" id="picture"></th>
		</tr>
		<tr>
			<th><label for="category">Catégorie :</label></th>
			<th>
				<select name="category" id="category">
					<?php
					while ($data = $category2->fetch()){
						?>
						<option value="<?= $data['ID'] ?>"><?= $data['category'] ?></option>
						<?php
					}
					?>
				</select>
			</th>
		</tr>
		<tr>
			<th></th>
			<th><input type="submit" value="Confirmer"></th>
		</tr>
	</table>
</form>
<?php $body = ob_get_clean(); ?>
<?php require('template.php'); ?>