<?php

session_start();

if(!isset($_COOKIE['log']) && isset($_SERVER['HTTP_REFERER'])){
	setcookie('log',  $_SERVER['HTTP_REFERER']);
	header('Location: http://127.0.0.1/Hades/page/user.php');
}
if(isset($_SESSION['id_user'])){
	header('Location: ../index.php');
}
else{
	if(isset($_POST['create'])){
		$msg = '';
		if(empty($_POST['username'])){
			$msg .= '<span class="warning">Veuillez renseigner votre pseudo.</span><br/>';
		}
		else if(strlen($_POST['username']) < 2){
			$msg .= '<span class="warning">Votre pseudo doit comporter au moins 2 caractères.</span><br/>';
		}
		if(empty($_POST['email'])){
			$msg .= '<span class="warning">Veuillez renseigner votre adresse mail.</span><br/>';
		}
		else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			$msg .= '<span class="warning">Votre email est considéré comme invalide</span><br/>';
		}
		if(empty($_POST['password'])){
			$msg .= '<span class="warning">Veuillez renseigner un mot de passe.</span><br/>';
		}
		else if(strlen($_POST['password']) < 8){
			$msg .= '<span class="warning">Votre mot de passe doit comporter au moins 8 caractères.</span><br/>';
		}
		if(empty($_POST['pass'])){
			$msg .= '<span class="warning">Veuillez confirmer votre mot de passe</span><br/>';
		}
		if(!empty($_POST['password']) && !empty($_POST['pass'])){
			if($_POST['password'] != $_POST['pass']){
			$msg .= 'Les mots de passes doivent êtres identiques.';
			}
		}
		if(empty($msg)){
		    require_once('../db.php');

			$pass = mysqli_real_escape_string($cnx, sha1($_POST['pass']));
			$password = mysqli_real_escape_string($cnx, sha1($_POST['password']));
		    $email = mysqli_real_escape_string($cnx, $_POST['email']);
		    $username = mysqli_real_escape_string($cnx, $_POST['username']);
	      	if($username&&$email&&$pass&&$password){
		        if($pass == $password){
		           	$sql = "INSERT INTO `User` SET username = '$username', email = '$email', password = '$password'";
		            $select = mysqli_query($cnx, $sql);
		       	    include_once('./includes/mail.php');
		            header('Location: ./user.php');
	            }
	        }
		}
	    echo $msg;
	}
	//////
	if(isset($_POST['login'])){
		require_once('../db.php');

		$username = $_POST['username'];
	    $password = sha1($_POST['password']);

	    $sql = "SELECT * FROM User WHERE (email = '$username' OR username = '$username') AND password = '$password'";
        $select = mysqli_query($cnx, $sql);
	    if($username&&$password){
	        if($s = mysqli_fetch_assoc($select)){
	            $email = $s['email'];
	            $_username = $s['username'];
	            $pw = $s['password'];
	                if(($username==$email || $username = $_username)&&$password==$pw){
		                $_SESSION['id_user'] = $s['id_user'];
		                $_SESSION['email'] = $s['email'];
		                $_SESSION['password'] = $password;
		                if(isset($_COOKIE['log'])){
	                    	header("Location:".  $_COOKIE['log']);
	                    }else{
	                    	header("Location: http://127.0.0.1/Hades");
	                    }
	                }
	        }
	        else{
	                	/// Coookie affichage 2sec message
	        }
	   }
	}
	 
	//////
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/user.css">        
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/6c4c06c2fd.js" crossorigin="anonymous"></script>
</head>
<body class="text-center" >
	<div class="backchild"></div>
	<a href="<?php echo $_COOKIE['log'];?>"><img id="return" src="../img/return.svg"></a>
	<main id="register_connection">
		<section id="connection">
		   	<!-- CONNECTION -->
		    <form class="form-signin" method="POST">
		   	<h2 class="h3 mb-3 font-weight-normal">Connexion</h2>
		        <input class="form-control mb-1" type="text" name="username" placeholder="mail" value="<?php
		        if(isset($_POST['username']) && isset($_POST['login'])){
		        	echo $_POST['username'];
		        } ?>">
		        <input class="form-control mb-1" type="password" name="password" placeholder="votre mot de passe...">
		        <input class="btn btn-lg btn-primary btn-block mb-1" type="submit" name="login">
		    </form>
		</section>
		<section id="register">
		    <form class="form-signin" method="POST">
				<h2 class="h3 mb-3 font-weight-normal">Inscription</h2>
		    	<input class="form-control mb-1" type="text" name="username" value="<?php
		    	if(isset($_POST['username']) && isset($_POST['create'])){
		    		echo $_POST['username'];
		    	} ?> ">
		        <input class="form-control mb-1" type="text" name="email" value="<?php
		        if(isset($_POST['email'])){
		        	echo $_POST['email'];
		        } ?>">
		        <input class="form-control mb-1" type="password" name="password">
		        <input class="form-control mb-1" type="password" name="pass">
		        <div class="checkbox mb-3 mb-1">
		            <input type="checkbox" name="checkbox" required>
		            <label for="checkbox">J'accepte les <a href="">Conditions Générales d'Utilisations</a></label>
		        </div>
		        <input class="btn btn-lg btn-primary btn-block mb-1" type="submit" name="create">
		    </form>
		</section>
	</main>
		<p class="mt-5 mb-3 text-muted">© 2020-2021</p>
</body>
</html>