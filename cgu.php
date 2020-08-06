<?php
if(isset($_SERVER['HTTP_REFERER']) && !isset($_COOKIE['log'])){
	setcookie('log',  $_SERVER['HTTP_REFERER']);
	header('Location: http://127.0.0.1/Hades/cgu.php?cgu=fr');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<html>
<head>
	<meta charset="utf-8">
    <title>A.D.S : Conditions Générales d'Utilisations</title>
    <link rel="stylesheet" type="text/css" href="http://127.0.0.1/Hades/css/file.css">
</head>
<body>
<form>
	<div id="display_return_list">
		<a href="<?php echo $_COOKIE['log'];?>"><img id="return" src="./img/return.svg"></a>
		<select id="list-cgu" onchange="list_cgu();">
			<option style="display: none;"></option>
			<option value="fr">FR</option>
			<option value="en">EN</option>
			<option value="es">ES</option>
		</select>
	</div>
	<main>
		<section>
		<?php
		/* --- FR VERSION --- */
		if(!isset($_GET['cgu']) || $_GET['cgu'] == 'fr'){
			include_once('./file/cgu_fr.txt');
		}
		else if(isset($_GET['cgu'])){
			$cgu = $_GET['cgu'];
		/* --- EN VERSION --- */
			if($cgu == 'en'){
				include_once('./file/cgu_en.txt');
			}
		/* --- ES VERSION --- */
			if($cgu == 'es'){
				include_once('./file/cgu_es.txt');
			}
		}
		?>
		</section>
	</main>
	<script type="text/javascript" src="./js/file.js"></script>
</body>
</html>
