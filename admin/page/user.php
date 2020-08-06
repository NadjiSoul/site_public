<?php
session_start();
if(isset($_SESSION['id_superuser'])){
	header('Location: ../index.php');
}
else{	//////
	require_once('../../db.php');

	if(isset($_POST['login'])){

		$username = $_POST['username'];
	    $password = sha1($_POST['password']);

	    $sql = "SELECT * FROM SuperUser WHERE (email = '$username' OR username = '$username') AND password = '$password'";
        $select = mysqli_query($cnx, $sql);
	    if($username&&$password){
	        if($s = mysqli_fetch_assoc($select)){
	            $email = $s['email'];
	            $_username = $s['username'];
	            $pw = $s['password'];
	            if(($username==$email || $username == $_username)&&$password==$pw){
		            $_SESSION['id_superuser'] = $s['id_superuser'];
		            $_SESSION['email'] = $s['email'];
	                $_SESSION['password'] = $password;
                  	header("Location: ../index.php");
	            }
	            else{
	                	/// Coookie affichage 2sec message
	            }
	       	}
	    }
	}
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title></title>
	</head>
	<body>
		<section id="connection">
		   	<!-- CONNECTION -->
		   	<h2>Connexion</h2>
		    <form class="con_discon" method="POST" id="forma">
		        <input type="text" name="username" placeholder="mail" value="<?php
		        if(isset($_POST['username']) && isset($_POST['login'])){
		        	echo $_POST['username'];
		        } ?>">
		        <input type="password" name="password" placeholder="votre mot de passe...">
		        <input type="submit" name="login">
		    </form>
		</section>
	</body>
	</html>
	<?php
}

?>