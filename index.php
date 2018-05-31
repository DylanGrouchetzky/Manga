<?php
require('controller/frontend.php');

try{
	if(isset($_GET['page'])){
		listMangaNext($_GET['page']);
	}
	elseif(isset($_GET['pageTome'])){
		tomeNext($_GET['id'], $_GET['pageTome']);
	}
	elseif (isset($_GET['action'])){
		if($_GET['action'] == 'listManga'){
			listManga();
		}
		elseif ($_GET['action'] == 'tome'){
			if (isset($_GET['id']) && $_GET['id'] > 0){
				tome($_GET['id']);
			}else{
				throw new Exception("Aucun identifiant de manga envoyé !");
			}
		}
		elseif ($_GET['action'] == 'formtome'){
			formTome();
		}
		elseif ($_GET['action'] == 'addTome'){
			if (!empty($_POST['name']) OR !empty($_POST['number'])) {
				addTome($_POST['mangaID'], $_POST['name'], $_POST['picture'], $_POST['amount'], $_POST['number']);
			}else{
				throw new Exception("Il manque le nom et l'image");
			}	
		}
		elseif ($_GET['action'] == 'formmanga'){
			formManga();
		}
		elseif ($_GET['action'] == 'addManga'){
			if (!empty($_POST['name']) && !empty($_POST['picture'])){
				addManga($_POST['name'], $_POST['picture'], $_POST['category']);
			}else{
				throw new Exception("Il manque le nom et l'image");
			}
		}
		elseif ($_GET['action'] == 'formcategory'){
			formCategory();
		}
		elseif ($_GET['action'] == 'addCategory'){
			if (!empty($_POST['name'])){
				addCategory($_POST['name']);
			}else{
				throw new Exception("Il manque le nom");
			}
		}
		elseif ($_GET['action'] == "selectCategory"){
			if (isset($_GET['id']) && $_GET['id'] > 0){
				selectCategory();
			}else{
				throw new Expeption("Aucun identifiant de category envoyé !");
			}
		}
		elseif ($_GET['action'] == "update"){
			selectUpdate();
		}
		elseif ($_GET['action'] == 'updateManga'){
			updateManga();
		}
		elseif ($_GET['action'] == 'editManga'){
			editManga($_POST['name'], $_POST['newName'], $_POST['newPicture'], $_POST['newCategory']);
		}
		elseif ($_GET['action'] == 'updateTome'){
			if (isset($_GET['id'])) {
				updatetome($_GET['id']);
			}else{
			selectManga();
			}
		}
		elseif ($_GET['action'] == 'editTome'){
			editTome($_POST['name'], $_POST['newName'], $_POST['newPicture'], $_POST['newAmount']);
		}
		elseif ($_GET['action'] == 'search') {
			search($_POST['search']);
		}
	}else{
		listManga();
	}
}
catch(Expeption $e){
	echo 'Erreur : '.$e->getMessage();
}