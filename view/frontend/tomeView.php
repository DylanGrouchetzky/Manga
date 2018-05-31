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
<h1>Les Tomes</h1>
<table>
	<?php
	while ($tomes = $tome->fetch()){
		?>
		<tr>
			<th>
				<?php
				if ($tomes['quantite'] > 0){
					?>
					<img src="public/image/<?= $tomes['picture']; ?>" class="thumbnail">
					<?php
				}else{
					?>
					<img src="public/image/<?= $tomes['picture']; ?>" class="thumbnail" style="-webkit-filter: grayscale(100%); -webkit-filter: grayscale(100%);">
					<?php
				}
				?>
			</th>
			<th><p>Nom : <?= $tomes['name'] ?></p></th>
			<th><p>Quantité : <?= $tomes['quantite']; ?></p></th>	
		</tr>
		<?php
	}
	?>
	<tr>
		<th></th>
		<th>
			<?php 
				for ($i=1;$i<=$numberPage;$i++){
					if($i == $pageCourante){
						echo $i.' ';
					}else{
						echo '<a href="index.php?pageTome='.$i.'&amp;id='.$id.'">'.$i.'</a>';
					}
				}
			?>
		</th>
	</tr>
</table>
<?php $body = ob_get_clean(); ?>
<?php require('template.php'); ?>