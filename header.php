<?php

require_once(dirname(__FILE__).'/db.php');

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
	$url = "https"; 
else
	$url = "http"; 
	$url .= "://";
	$url .= $_SERVER['HTTP_HOST']; 
	$url .= $_SERVER['REQUEST_URI'];
				
if(isset($_GET['color'])){
	$color = $_GET['color'];
	if($color == 0){
		setcookie('color', 0);
	}
	else if($color == 1){
		setcookie('color', 1);
		}
}
setcookie('log');
  // Suppression de la valeur du tableau $_COOKIE
unset($_COOKIE['log']);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ADS : Art Of DaiShizen</title>
	<link rel="icon" href="./img/favicon.svg"/>
	<link rel="stylesheet" type="text/css" href="http://127.0.0.1/Hades/css/main.css">
<!--
	<?php
	if(!isset($_COOKIE['color']) || $_COOKIE['color'] == 1){
	?>
		<link rel="stylesheet" type="text/css" href="http://127.0.0.1/Hades/css/white.css">
	<?php
	}
	else{
	?>
		<link rel="stylesheet" type="text/css" href="http://127.0.0.1/Hades/css/black.css">
	<?php
	}
	?>
-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6c4c06c2fd.js" crossorigin="anonymous"></script>

	<script type="text/javascript" src="http://127.0.0.1/Hades/js/color.js"></script>
</head>
<body id="entete">
	<div class="blue_exorcist"></div>
	<header>
		<div class="background">
			<div id="title">
				<a title="Home" alt="Home" href="http://127.0.0.1/Hades"><i class="fab fa-phoenix-framework"></i></a>
				<h2 class="title_focus_a">A.D.S</h2>
				<div>
					<h1 class="title_focus_b"><span>A</span>rt Of <span>D</span>ai <span>S</span>hizen</h1>
				</div>
			</div>
			<div class="backchild"></div>
		</div>
	</header>
		<nav class="navbar navbar-expand-lg
		<?php 
		if(!isset($_COOKIE['color']) || $_COOKIE['color'] == 1){
			echo "bg-light navbar-light";
		}
		else{
			echo "bg-dark navbar-dark";
		}?>
		 nav-sticky">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="navbar-toggler-icon"></span>
		    </button>
		    <a title="Accueil" alt="Accueil" class="pheonix" href="http://127.0.0.1/Hades"><i class="fab fa-phoenix-framework"></i></a>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-link"><a title="Accueil" alt="Accueil" href="http://127.0.0.1/Hades"><i class="fas fa-house-user focus"></i></a></li>
					<?php

					$sql = 'SELECT * FROM Type';
					$select = mysqli_query($cnx, $sql);
					while($s = mysqli_fetch_assoc($select)){
					?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $s['name']; ?></a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li class="dropdown-item"><a class="nav-link" onclick="location.href='http://127.0.0.1/Hades/index.php?type=<?php echo $s['id_type'];?>'">All</a></li>
								<?php

								$_sql = 'SELECT * FROM Category';
								$_select = mysqli_query($cnx, $_sql);
								while($_s = mysqli_fetch_assoc($_select)){
								?>
								<li class="dropdown-item"><a onclick="location.href='http://127.0.0.1/Hades/index.php?type=<?php echo $s['id_type'];?>&category=<?php echo $_s['id_category'];?>'"><?php echo $_s['label'];?></a></li>
								<?php
								}
								?>
							</ul>
						</li>
					<?php
					}
					?>
					<li class="nav-item dropdown" >
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Genre</a>
						<ul class="dropdown-menu
						<?php if(isset($_COOKIE['color']) && $_COOKIE['color'] == 0){
							echo "bg-dark";
						};?>" aria-labelledby="navbarDropdown">
							<?php
							$sql = "SELECT * FROM Category";
							$select = mysqli_query($cnx, $sql);
							while($s = mysqli_fetch_assoc($select)){
							?>
							<li class="dropdown-item"><a onclick="location.href='http://127.0.0.1/Hades/index.php?category=<?php echo $s['id_category'];?>'"><?php echo $s['label'];?></a></li>
							<?php
							}
							?>
						</ul>
					</li>
					<?php
					if(!isset($_COOKIE['color']) || $_COOKIE['color'] == 1){
					?>
					<li class="nav-link"><a title="Mode nuit" alt="Mode nuit" onclick="location.href='<?php echo $url;?>?color=0'"><i class="fas fa-moon"></i>

	</a></li>
					<?php
					}else if(isset($_COOKIE['color']) && $_COOKIE['color'] == 0){
					?>
					<li class="nav-link"><a title="Mode jour" alt="Mode jour" onclick="location.href='<?php echo $url;?>?color=1'"><i class="fas fa-sun"></i></a></li>
					<?php
					}
					if(isset($_SESSION['id_user'])){
						?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Compte" alt="Compte" href="#"><i class="fas fa-user-circle focus"></i></a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<!-- color #979A9D -->
							<li class="dropdown-item"><a class="nav-link link-account" href="http://127.0.0.1/Hades/page/account.php">Mon Compte</a></li>
							<li class="dropdown-item"><a class="nav-link link-account" href="http://127.0.0.1/Hades/page/artwork_m.php">Mes Oeuvres</a></li>
						</ul>
					</li>
					<?php
					}
					?>
					<li class="nav-link"><a title="Contact" alt="Contact" href="http://127.0.0.1/Hades/page/contact.php"><i class="fas fa-envelope"></i></a></li>
					<?php
					if(isset($_SESSION['id_user'])){
					?>
					<li class="nav-link connect disconnect"><a title="Se déconnecter" alt="Se déconnecter" href="http://127.0.0.1/Hades/disconnect.php"><i class="fas fa-sign-out-alt cnx"></i></a></li>
					<?php
					}
					else{
					?>
					<li class="nav-link connect"><a  title="Se connecter" alt="Se connecter" href="http://127.0.0.1/Hades/page/user.php"><i class="fas fa-sign-in-alt cnx"></i></a></li>
					<?php
					}
					?>
				</ul>
			    <form class="form-inline my-2 my-lg-0" method="GET">
			      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" value="<?php 
			      if(isset($_GET['search'])){
			      	echo $_GET['search'];
			      }?>">
			      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			    </form>
			</div>
		</nav>	
		<main
		class="
		<?php 
		if(!isset($_COOKIE['color']) || $_COOKIE['color'] == 1){
			echo "bg-light";
		}
		?>"
		>

<style>
	<?php
	if(isset($_COOKIE['color']) && $_COOKIE['color'] == 0){
	?>
		main{
			background-color: black;
		}
		.dropdown-menu{
			background-color: #343A40;
		}
		.dropdown-item{
			color: #979a9d;
		}
		.dropdown-item:hover{
			color: #BFBFBF;
			background-color: black !important;
		}
		.col-md-4 *{
			color: #FAFAFA !important;
		}
		.white{
			color: #FAFAFA !important;
		}
	<?php
	}
	?>
</style>