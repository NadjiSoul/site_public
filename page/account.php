<?php 
	session_start();
	
	if(isset($_SESSION['id_user'])){
	require_once('../header.php'); 



	?>
	<form class="form-signin" id="form-account" method="POST" enctype="multipart/form-data" action="./treatment/account_treatment.php">
	<!-- Modifier mes informations perso-->
	<?php
		$user = $_SESSION['id_user'];
		$sql = "SELECT * FROM User WHERE id_user = $user";
		$select = mysqli_query($cnx, $sql);
		if($s = mysqli_fetch_assoc($select)){
			if(empty($s['avatar'])){
			?>
		<i class="fas fa-user"></i>
			<?php
			}
			else{
			?>
		<img width="100%" height="225" src="../img/avatar/<?php echo $s['avatar'];?>">
			<?php
			}
		?>
		<div>
		  <!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
<!-- 			  <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
 -->		  <!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES -->
 			<label for="file" class="label-file btn-block btn btn-secondary">Choisir une image</label>
		  	<input style="display:none;" id="file" name="file-img[]" type="file" />

			<input class="form-control" type="text" name="username" value="<?php echo $s['username'];?>">
			<input class="form-control" type="text" name="email" value="<?php echo $s['email'];?>">
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="modify"><i class="fas fa-pen"></i></button>
		</div>
		<?php
		}
?>
	</form>
			<!-- 
		<input type="file" name="file" id="image-file" onchange="SavePhoto(this)"> -->
</main>
<?php require_once('../footer.php'); ?>
</body>
</html>
<?php
	}
	else{
		header('Location: ./user.php');
	}

