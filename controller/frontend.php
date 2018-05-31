<?php

require_once('model/ViewManager.php');
require_once('model/InsertManager.php');

function listMangaNext($page){
	$viewManager = new ViewManager();
	$category = $viewManager->category();
	$pageCourante = $_GET['page'];
	$start = ($pageCourante-1)*5;
	$numberPage = $viewManager->numberPageManga(5);
	$manga = $viewManager->displayManga($start, 5);

	require('view/frontend/listMangaView.php');
}

function listManga(){
	$viewManager = new ViewManager();
	$category = $viewManager->category();
	$pageCourante = 1;
	$start = ($pageCourante-1)*5;
	$numberPage = $viewManager->numberPageManga(5);
	$manga = $viewManager->displayManga($start, 5);

	require('view/frontend/listMangaView.php');
}

function tome($id){
	$viewManager = new ViewManager();
	$category = $viewManager->category();
	$pageCourante = 1;
	$start = ($pageCourante-1)*10;
	$numberPage = $viewManager->numberPageTome(10, $id);
	$tome = $viewManager->displayTome($id, $start, 10);
	$nameManga = $viewManager->selectManga($id);

	require('view/frontend/tomeView.php');
}

function tomeNext($id, $page){
	$viewManager = new ViewManager();
	$category = $viewManager->category();
	$pageCourante = $_GET['pageTome'];
	$start = ($pageCourante-1)*10;
	$numberPage = $viewManager->numberPageTome(10, $id);
	$tome = $viewManager->displayTome($id ,$start, 10);
	$nameManga = $viewManager->selectManga($id);

	require('view/frontend/tomeView.php');
}

function addTome($mangaID, $nameTome, $picture, $amount, $number){
	if(!empty($_POST['number'])){
		$viewManager = new ViewManager();
		$tome = $viewManager->listTome($mangaID);
		$numberLineTotal = $tome->rowCount();
		for ($i=1; $i <= $number; $i++) {
			$numberTome = $numberLineTotal + $i; 
			$nameTome = "Tome ".$numberTome;
			$insertManager = new InsertManager();
			$newTome = $insertManager->treatmentTome($mangaID, $nameTome, $picture, $amount);
		}
		header('Location: index.php?action=tome&id='.$mangaID);
	}
	elseif(empty($_POST['number'])) {
		$insertManager = new InsertManager();
		$newTome = $insertManager->treatmentTome($mangaID, $nameTome, $picture, $amount);

		if($newTome === false){
			throw new Exception("Impossible d'ajouter le tome !");
		}else{
			header('Location: index.php?action=tome&id='.$mangaID);
		}
	}

}

function formTome(){
	$viewManager = new ViewManager();
	$manga = $viewManager->getManga();
	$category = $viewManager->category();

	require('view/frontend/formTomeView.php');
}

function addManga($name, $picture, $category){
	$insertManager = new InsertManager();
	$newManga = $insertManager->treatmentManga($name, $picture, $category);

	if ($newManga === false){
		throw new Exception("Impossible d'ajouter le manga !");
	}else{
		header('Location: index.php');
	}
}

function formManga(){
	$viewManager = new ViewManager();
	$category = $viewManager->category();
	$category2 = $viewManager->category();

	require('view/frontend/formMangaView.php');
}

function addCategory($name){
	$insertManager = new InsertManager();
	$newCategory = $insertManager->treatmentCategory($name);

	if ($newCategory === false){
		throw new Exception("Impossible d'ajouter la catégory");
	}else{
		header('Location: index.php');
	}
}

function formCategory(){
	$viewManager = new ViewManager();
	$category = $viewManager->category();
	require('view/frontend/formCategoryView.php');
}

function selectCategory(){
	$viewManager = new ViewManager();
	$selectCategory = $viewManager->displayCategory($_GET['id']);
	$category = $viewManager->category();

	require ('view/frontend/categoryView.php');
}

function nameCategory($ID){
	$viewManager = new ViewManager();
	$name = $viewManager->nameCategory($ID);
	return $name;
}

function numberTome($id){
	$viewManager = new ViewManager();
	$numberTome = $viewManager->numberTome($id);
	return $numberTome;
}

function selectUpdate(){
	$viewManager = new ViewManager();
	$category = $viewManager->category();

	require('view/frontend/updateView.php');
}

function updateManga(){
	$viewManager = new ViewManager();
	$category = $viewManager->category();
	$nameCategory = $viewManager->category();
	$nameManga = $viewManager->getManga();

	require('view/frontend/mangaUpdateView.php');
}

function selectManga(){
	$viewManager = new ViewManager();
	$category = $viewManager->category();
	$nameManga = $viewManager->getManga();

	require('view/frontend/tomeUpdateView.php');
}

function updateTome($ID){
	$viewManager = new ViewManager();
	$category = $viewManager->category();
	$nameManga = $viewManager->selectManga($ID);
	$nameTome = $viewManager->listTome($ID);

	require('view/frontend/tomeUpdateView.php');
}

function editManga($ID, $newName, $newPicture, $newCategory){
	$insertManager = new InsertManager();
	$viewManager = new ViewManager();
	$origin = $viewManager->selectManga($ID);
	if (empty($_POST['newName'])){
		$newName = $origin['name'];
	}
	if (empty($_POST['newPicture'])){
		$newPicture = $origin['picture'];
	}
	$update = $insertManager->treatmentUpdateManga($ID, $newName, $newPicture, $newCategory);

	if ($newManga === false){
		throw new Exception("Impossible de mettre a jour le manga !");
	}else{
		header('Location: index.php');
	}
}

function editTome($ID, $newName, $newPicture, $newAmount){
	$insertManager = new InsertManager();
	$viewManager = new ViewManager();
	$origin = $viewManager->selectTome($ID);
	if (empty($_POST['newName'])){
		$newName = $origin['name'];
	}
	if (empty($_POST['newPicture'])){
		$newPicture = $origin['picture'];
	}
	if ($_POST['newAmount'] > '0' OR $_POST['newAmount'] == '0' ){
		$newAmount = $_POST['newAmount'];
	}else{
		$newAmount = $origin['quantite'];
	}
	$update = $insertManager->treatmentUpdateTome($ID, $newName, $newPicture, $newAmount);

	if ($newManga === false){
		throw new Exception("Impossible de mettre a jour le tome !");
	}else{
		header('Location: index.php');
	}
}

function search($name){
	$viewManager = new ViewManager();
	$category = $viewManager->category();
	$search = $viewManager->searchManga($name);

	require('view/frontend/resultView.php');
}