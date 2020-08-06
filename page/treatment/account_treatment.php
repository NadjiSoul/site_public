<?php

if(isset($_POST)){
	
	require_once('../../db.php');
	session_start();

	$user = $_SESSION['id_user'];
	if(isset($_POST['modify'])){
		$username = $_POST['username'];
		$email = $_POST['email'];
		$avatar =  $_FILES['file-img']['name'][0];

		$_sql = "SELECT * FROM User WHERE id_user = $user";
		$_select = mysqli_query($cnx, $_sql);

		if($_s = mysqli_fetch_assoc($_select)){
			if(empty($avatar)){
				$avatar = $_s['avatar'];
			}
			if(!empty($avatar) && !empty($_s['avatar'])){
				unlink('../../img/avatar/'.$_s['avatar']);
			}
		}

		$sql = "UPDATE User SET username = '$username', email = '$email', avatar = '$avatar' WHERE id_user = $user";
		mysqli_query($cnx, $sql);

		$uploaddir = '../../img/avatar/';
		require_once('./upload_img.php');

		header("location:".  $_SERVER['HTTP_REFERER']); 
	}

}