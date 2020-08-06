<?php

require_once('../../../db.php');
session_start();

if(isset($_GET['active'])){
	$active = $_GET['active'];
	$chapter = $_GET['chapter'];
	if($active == 0){
		$report = 1;
	}
	else{
		$report = 0;
	}
	$sql = "UPDATE Chapter SET active = $active, report = $report WHERE id_chapter = $chapter";
	mysqli_query($cnx, $sql);

	header("location:".  $_SERVER['HTTP_REFERER']);

}

if(!isset($_GET['active']) && isset($_GET['chapter'])){
	$id_chapter = $_GET['chapter'];

	$sql = "UPDATE Chapter SET report = 1 WHERE id_chapter = $id_chapter";
	mysqli_query($cnx, $sql);
	var_dump($sql);
	
	header("location:".  $_SERVER['HTTP_REFERER']);
}