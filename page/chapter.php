<?php

session_start();
require_once('../header.php');

?>
		<section>
			<?php
			if(isset($_GET['chapter'])){
				$chapter_id = $_GET['chapter'];
	            $sql = "SELECT Artwork.*, Chapter.name AS chapter_name, Chapter.content AS chapter_content, Chapter.id_chapter AS chapter_id_chapter FROM Artwork
	            INNER JOIN Chapter ON Artwork.id_artwork = Chapter.artwork_id
	            WHERE Chapter.id_chapter = $chapter_id
	            AND Chapter.active = 1";
				$select = mysqli_query($cnx, $sql);
				while($s = mysqli_fetch_assoc($select)){
				?>
				<article>
					<div class="description card bg-dark">
						<div>
							<h2 class="black"><?php echo $s['title']; ?></h2>
							<!-- Manga info-->
							<a class="btn btn-info" href="http://127.0.0.1/Hades/page/artwork.php?artwork=<?php echo $s['id_artwork'];?>">Manga Info</a>			
						</div>
						<!-- Signaler -->
						<form method="POST" action="./treatment/post_report.php?chapter=<?php echo $s['chapter_id_chapter'];?>">
							<button type="submit" class="btn btn-warning">Signaler le contenu</button>
						</form>
						<!-- Fin Signaler -->
					</div>
					<!-- Parcourir chapitres (PREVIOUS-NEXT) -->

					<div class="bloc-img-chapter">
					<?php include('./treatment/previous_next.php') ?>
					<?php
					$liste_rep = scandir('../img/artwork/'.$s['title'].'/'.$s['chapter_name'].'/');  //       A REMPLIR !!!
					//$i = 2 car cela prend en compte le dossier actuel '.' et le dossier précédent '..' #terminal(invite commande)
				    $i = 2;
				    $num = count($liste_rep);
				    while($i < $num){
				    ?>
						<img src="http://127.0.0.1/Hades/img/artwork/<?php echo $s['title'].'/'.$s['chapter_name'].'/'.$liste_rep[$i]?>">
				    <?php
					    $i++;
				    }
				?>
					<?php include('./treatment/previous_next.php') ?>
					</div>
				</article>
				<?php
				}
				?>

		</section>
		<section id="post">

			<?php
			if(isset($_SESSION['id_user'])){
			?>
			<form method="POST" action="./treatment/post_treatment.php" class="col-md-10">
				<textarea style="resize: none;" class="form-control" name="content"></textarea>
				<button class="btn btn-primary" type="submit" name="add" value="<?php echo $chapter_id;?>">Laisser un commentaire</button>
			</form>
			<?php
			}
			else{
			?>
				<a href="http://127.0.0.1/Hades/page/user.php" class="btn btn-info">Veuillez vous connectez pour laisser un commentaire</a>
			<?php
			}
			$sql = "SELECT Post.*, User.username AS user_username, User.avatar AS user_avatar FROM Post
			INNER JOIN User ON Post.user_id = User.id_user 
			WHERE Post.chapter_id = $chapter_id";
			$select = mysqli_query($cnx, $sql);
			while($s = mysqli_fetch_assoc($select)){
			?>
			<form class="col-md-10" method="POST" action="./treatment/post_treatment.php">
				<div class="card mb-1 shadown-sm">
					<div class="card-body">
						<img style="width: 50px; height: 50px; border-radius: 50%; border: 1px solid black;" src="http://127.0.0.1/Hades/img/avatar/<?php 
						if(!empty($s['user_avatar'])){
							echo $s['user_avatar'];
						}
						else{
							echo 'avatar.svg';
						}?>">
						<?php 
						if(isset($_SESSION['id_user']) && $_SESSION['id_user'] == $s['user_id']){
						?>
						<textarea style="resize: none;" class="form-control col-md-10 white" name="content"><?php echo $s['content'];?></textarea>
						<div>
							<button class="btn btn-secondary" type="submit" name="modify" value="<?php echo $s['id_post'];?>">Modifier</button>
							<button class="btn btn-danger" type="submit" name="delete" value="<?php echo $s['id_post'];?>">Supprimer</button>
						</div>
						<?php
						}
						else{
						?>
							<p class="card-text"><?php echo $s['content'];?></p>
						<?php
						}
						?>
						<small class="form-text text-muted"><?php echo $s['postDate'];?> par <?php echo $s['user_username'];?></small>
					</div>	
				</div>
			</form>
			<?php
			}
			?>
		</section>
			<?php
			}
			?>
		
	</main>
	<?php require_once('../footer.php');?>
</body>
</html>