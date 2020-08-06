<?php 

session_start();

if(isset($_SESSION['id_user'])){
	require('../header.php'); ?>

	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#add">Ajouter une oeuvre</button>
	<!-- Modal -->
	<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Création d'une oeuvre</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <?php 
	      if(isset($_POST['create-artwork'])){
	      	$title = mysqli_escape_string($cnx, $_POST['title']);
	      	$type = mysqli_escape_string($cnx, $_POST['type']);
	      	$category = mysqli_escape_string($cnx, $_POST['category']);
	      	$description = mysqli_escape_string($cnx, $_POST['description']);
	      	$user_id = $_SESSION['id_user'];
	      	$structure = "../img/artwork/".$title;
	      	if(file_exists($structure)){
	      		var_dump('Un dossier comportant le même nom existe déjà...');
	      	}
			else if (!mkdir($structure, 0777, true)) {
			    var_dump('Echec lors de la création des répertoires...');
			}
			else{
				$img = $_FILES['file-img']['name'][0];

		      	$sql = "INSERT INTO Artwork SET title = '$title', img = '$img', type_id = (SELECT id_type FROM Type WHERE name = '$type'), category_id = (SELECT id_category FROM Category WHERE label = '$category'), description = '$description', user_id = $user_id";
		      	mysqli_query($cnx, $sql);

				$uploaddir = '../img/artwork/picture/';
				require_once('./treatment/upload_img.php');

			}
	      }?>
	      <form method="POST" enctype="multipart/form-data">
		      <div class="modal-body">
		      	<input type="text" name="title" class="form-control mb-1">
		      	<select name="type" class="form-control mb-1">
		      		<?php
		      		$sql = "SELECT * FROM Type";
		      		$select = mysqli_query($cnx, $sql);
		      		while($s = mysqli_fetch_assoc($select)){
		      		?>
		      		<option><?php echo $s['name']; ?></option>
		      		<?php
		      		}
		      		?>
		      	</select>
		      	<select name="category" class="form-control mb-1">
		      		<?php
		      		$sql = "SELECT * FROM Category";
		      		$select = mysqli_query($cnx, $sql);
		      		while($s = mysqli_fetch_assoc($select)){
		      		?>
		      		<option><?php echo $s['label']; ?></option>
		      		<?php
		      		}
		      		?>
		      	</select>
		      	<label for="file" class="btn btn-block btn-primary mb-1">Select. image</label>
		      	<input id="file" style="display: none;" type="file" name="file-img[]">
		      	<textarea name="description"></textarea>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" name="create-artwork" class="btn btn-info">Créer</button>
		      </div>
		  </form>
	    </div>
	  </div>
	</div>
	<table class="table table-striped table-sm table-modify">
		<h2 class="white">Artwork</h2>
		<?php
			$user = $_SESSION['id_user'];	            
			$sql = "SELECT * FROM Artwork WHERE user_id = $user";
			$select = mysqli_query($cnx, $sql);
			while($s = mysqli_fetch_assoc($select)){
			?>
			<tr>
				<td class="white"><a onclick="location.href='http://127.0.0.1/Hades/page/artwork.php?artwork=<?php echo $s['id_artwork'];?>'"><?php echo $s['title'];?></a></td>
				<!-- <td class="white"><?php echo $s['id_artwork'];?></td> -->
				<td class="button_artwork_table delet_element">
					<button type="button" class="delete_class btn btn-light" onclick="location.href='http://127.0.0.1/Hades/page/artwork.php?artwork=<?php echo $s['id_artwork'];?>'">Show</button>
					<button class="btn btn-secondary" onclick="location.href='http://127.0.0.1/Hades/page/artwork_v.php?artwork=<?php echo $s['id_artwork'];?>'">Chapitre</button>
					<button type="button" class="delete_class btn btn-danger" data-toggle="modal" data-target="#del" value="<?php echo $s['id_artwork'] ?>">Supprimer</button></td>
				</td>
			</tr>
			<?php
			}
		?>
	</table>	
	<?php

	if(isset($_GET['delete'])){


	   	$delete = $_GET['delete'];
		
		$sql_ = "SELECT Artwork.*, Chapter.name AS chapter_name FROM Artwork
	            INNER JOIN Chapter ON Artwork.id_artwork = Chapter.artwork_id
	            WHERE Chapter.artwork_id = $delete";
	    $select_ = mysqli_query($cnx, $sql_);
	    while($s_ = mysqli_fetch_assoc($select_)){
	    	//Artwork
	    	$dir = '../img/artwork/';
	    	//Chapter
			$_dir = $dir.$s_['title'].'/';
			//img
			$dir_ = $_dir.$s_['chapter_name'].'/';

			$liste_rep = scandir($dir_);
			$i = 2;
			$num = count($liste_rep);

			//Boucle afin d'effacer le contenu de chaque chapitre
			while($i < $num){
				$file = $dir_.$liste_rep[$i];
				unlink($file);
				$i++;
			}
			rmdir($dir_);
	    }

	    //Efface la racine du dossier de l'oeuvre

	    $sql__ = "SELECT * FROM Artwork WHERE id_artwork = $delete";
	    $select__ = mysqli_query($cnx, $sql__);
	    $s__ = mysqli_fetch_assoc($select__);

		rmdir('../img/artwork/'.$s__['title'].'/');
		unlink('../img/artwork/picture/'.$s__['img']);


		$__sql = "DELETE Post.* FROM Post INNER JOIN Chapter ON Post.chapter_id = Chapter.id_chapter WHERE Chapter.artwork_id = $delete";
		mysqli_query($cnx, $__sql);
		$_sql = "DELETE FROM Chapter WHERE artwork_id = $delete";
		mysqli_query($cnx, $_sql);
		$sql = "DELETE FROM Artwork WHERE id_artwork = $delete";
		mysqli_query($cnx, $sql);


	}?>
	<div class="modal fade" id="del" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">/!\ Attention /!\</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<p>Vous êtes sur le point de supprimer un élément.</p>
	      	<p>Voulez-vous continuez ?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-danger delete" onclick="delet();">Supprimer</button>
	      </div>
	    </div>
	  </div>
	</div>
</main>
<?php require('../footer.php');?>
</body>
</html>
<?php
}
else{
	header('Location: ./user.php');
}
