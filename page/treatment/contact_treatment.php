<?php
if(isset($_POST['send'])){

	$msg = '';

	if(empty($_POST['firstname'])){
		$msg .="Veuillez renseigner un prénom";
	}
	else if(strlen($_POST['firstname']) <= 2){
		$msg .="Votre prénom doit être supérieur ou égale à 2 caractères";
	}
	else{
		$_SESSION['f'] =  $_POST['firstname'];
	}

	if(empty($_POST['lastname'])){
		$msg .= "Veuillez renseigner un nom";
	}
	else if(strlen($_POST['lastname']) <= 2){
		$msg .= "Votre nom doit être supérieur ou égale à 2 caractères";
	}
	else{
		$_SESSION['l'] = $_POST['lastname'];
	}

	if(empty($_POST['email'])){
		$msg .= "Veuillez renseigner un email";
	}
	else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$msg .= "Votre email n'est pas considérée comme une email valide";
	}
	else{
		$_SESSION['e'] = $_POST['email'];
	}

	if(empty($_POST['subject'])){
		$msg .= "Veuillez renseigner un objet/sujet";
	}
	else{
		$_SESSION['s'] = $_POST['subject'];
	}

	if(empty($_POST['message'])){
		$msg .= "Veuillez renseigner un message";
	}
	else if(strlen($_POST['message']) < 20){
		$msg .= "Votre message doit être supérieur à 20 caractères";
	}
	else{
		$_SESSION['m'] = $_POST['message'];
	}

	if(empty($msg)){
		
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		
		if(empty($_POST['tel'])){
			$tel = 'Phone non renseigné';
		}
		else {
			$tel = $_POST['tel'];
		}
		$to_email = "rhode97@live.fr";
   		$subject = $_POST['subject'];
   		$header = "From: $email";
		$message = $firstname." ".$lastname.": ".$_POST['message']." Telephone: ".$tel;

		if(mail($to_email, $subject, $message, $header)){
			$msg = '<span class="notice">Votre message a bien été envoyé</span>';
		}
		else{
			$msg = '<span class="error">Une erreur est survenue. Veuillez réessayer ultérieurement.</span>';
			
		}
	}
}