<?php

session_start();

if(isset($_SESSION['id_user'])){
require('../header.php'); 

?>

	<a href="http://127.0.0.1/Hades/page/artwork_m.php"><img id="return" src="../img/return.svg"></a>
	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#add">Ajouter un chapitre</button>
	<!-- Modal -->
	<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Création d'un Chapitre</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <?php
	      if(isset($_POST['create-chapter'])){
	      	//$name = chaine de caractere + input number
	      	$name = mysqli_escape_string($cnx, 'n'.$_POST['number'].' ~');
	      	$content = mysqli_escape_string($cnx, $_POST['content']);
	      	$artwork_id = $_GET['artwork'];

	      	$sql = "SELECT * FROM Artwork WHERE id_artwork = $artwork_id";
	      	$select = mysqli_query($cnx, $sql);

	      	if($s = mysqli_fetch_assoc($select)){
	      		$structure = "../img/artwork/".$s['title']."/".$name;
	      		if (!mkdir($structure, 0777, true)) {
			   		die('Echec lors de la création des répertoires...');
				}
	      	}  	

	      	$sql = "INSERT INTO Chapter SET name = '$name', content = '$content', report = 0, active = 1, artwork_id = $artwork_id";
	      	mysqli_query($cnx, $sql);


			$uploaddir = '../img/artwork/'.$s['title']."/".$name."/";
			require_once('./treatment/upload_img.php');

	      }?>
	      <form method="POST" enctype="multipart/form-data">
		      <div class="modal-body">
		      	<label>Chapter n°</label>
		      	<input class="form-control mb-1" type="number" name="number">
		      	<label class="btn btn-block btn-primary mb-1" for="file">Select. image </label>
		      	<input style="display: none;" id="file" type="file" name="file-img[]" multiple>
		      	<textarea class="form-control mb-1" name="content" rows=20></textarea>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" name="create-chapter" class="btn btn-info">Créer</button>
		      </div>
		  </form>
	    </div>
	  </div>
	</div>
	<table class="table table-striped table-sm">
	<?php
		if(isset($_GET['artwork'])){
			$user = $_SESSION['id_user'];
			$artwork = $_GET['artwork'];
			$sql = "SELECT * FROM Chapter WHERE artwork_id = $artwork";
			$select = mysqli_query($cnx, $sql);
			while($s = mysqli_fetch_assoc($select)){
			?>
			<tr>
				<td class="white"><?php echo $s['name'];?></td>
				<td class="button_artwork_table delete_element">
					<button type="button" class="delete_class btn btn-light" onclick="location.href='http://127.0.0.1/Hades/page/chapter.php?chapter=<?php echo $s['id_chapter'];?>'">Show Chapter</button>
					<button type="button" class="delete_class btn btn-danger" data-toggle="modal" data-target="#dialog" value="<?php echo $s['id_chapter'] ?>">Supprimer</button>
				</td>
			</tr>

			<?php
			}
		}

	?>
	</table>
	<!-- Modal -->
	<?php
	if(isset($_GET['delete'])){
		$delete = $_GET['delete'];

		$__sql = "SELECT Artwork.*, Chapter.name AS chapter_name FROM Artwork
	            INNER JOIN Chapter ON Artwork.id_artwork = Chapter.artwork_id
	            WHERE Chapter.id_chapter = $delete";
		$__select = mysqli_query($cnx, $__sql);

		if($__s = mysqli_fetch_assoc($__select)){

			$dir = '../img/artwork/'.$__s['title'].'/'.$__s['chapter_name'].'/';
			$liste_rep = scandir($dir);
			var_dump($liste_rep);
							//$i = 2 car cela prend en compte le dossier actuel '.' et le dossier précédent '..' #terminal(invite commande)
			$i = 2;
			$num = count($liste_rep);
			while($i < $num){
				$file = $dir.$liste_rep[$i];
				unlink($file);
				$i++;
			}
			rmdir($dir);
		}

		$_sql = "DELETE FROM Post WHERE chapter_id = $delete";
		mysqli_query($cnx, $_sql);
		$sql = "DELETE FROM Chapter WHERE id_chapter = $delete";
		$select = mysqli_query($cnx, $sql);
	}?>
	<div class="modal fade" id="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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