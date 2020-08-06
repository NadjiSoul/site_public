<?php

if(isset($_POST)){

	require_once('../../db.php');
	session_start();

	if(isset($_GET['chapter'])){
		$id_chapter = $_GET['chapter'];

		$sql = "UPDATE Chapter SET report = 1 WHERE id_chapter = $id_chapter";
		mysqli_query($cnx, $sql);
		var_dump($sql);
		header("location:".  $_SERVER['HTTP_REFERER']);
	}

}