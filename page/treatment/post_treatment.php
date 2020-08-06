<?php
if(isset($_POST)){

	require_once('../../db.php');
	session_start();

	$user = $_SESSION['id_user'];
	$postDate = date('Y-m-d H:i:s');
	if(isset($_POST['content'])){
		$content = mysqli_escape_string($cnx, $_POST['content']);
	}
	//ADD POST
	if(isset($_POST['add'])){
		$chapter = $_POST['add'];
		$sql = "INSERT INTO Post SET content = '$content', postDate = '$postDate', chapter_id = $chapter, user_id = $user";
	}
	//MODIFY POST 
	else if(isset($_POST['modify'])){
		$post = $_POST['modify'];
		$sql = "UPDATE Post SET content = '$content', postDate = '$postDate' WHERE id_post = $post AND user_id = $user";
	}

	else if(isset($_POST['delete'])){
		$post = $_POST['delete'];
		$sql = "DELETE FROM Post WHERE id_post = $post AND user_id = $user";
	}
	mysqli_query($cnx, $sql);
	header("location:".  $_SERVER['HTTP_REFERER']);
}