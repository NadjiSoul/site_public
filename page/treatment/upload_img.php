<?php
if(isset($uploaddir)){

	for($i = 0 ; $i < sizeof($_FILES['file-img']['name']); $i++){
		$uploadfile = $uploaddir . basename($_FILES['file-img']['name'][$i]);

		echo '<pre>';

		if(move_uploaded_file($_FILES['file-img']['tmp_name'][$i], $uploadfile)) {
			echo "Le fichier est valide, et a été téléchargé
				           avec succès. Voici plus d'informations :\n";
		} 
		else {
			echo "Attaque potentielle par téléchargement de fichiers.
				          Voici plus d'informations :\n";
		}

		echo 'Voici quelques informations de débogage :';
		print_r($_FILES);

		echo '</pre>';
	}

}
