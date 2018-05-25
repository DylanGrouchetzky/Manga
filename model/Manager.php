<?php 

class Manager{

	protected function dbConnect(){
		$db = new PDO('mysql:host=localhost;dbname=manga2;charset=utf8', 'root' , '');

		return $db;

	}
}