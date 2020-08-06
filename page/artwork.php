<?php 

session_start();

require_once('../header.php');?>
	<section class="container">
		<?php
		if(isset($_GET['artwork'])){
			$artwork_id = $_GET['artwork'];    
			$sql = "SELECT Artwork.*, Chapter.name AS chapter_name, Chapter.id_chapter AS id_chapter FROM Artwork
            INNER JOIN Chapter ON Artwork.id_artwork = Chapter.artwork_id
            WHERE Artwork.id_artwork = $artwork_id
            AND Chapter.active = 1";
			$select = mysqli_query($cnx, $sql);
			$_select = mysqli_query($cnx, $sql);
			if($_s = mysqli_fetch_assoc($_select)){
			?>
			<div class="description card bg-dark">
				<img width=400 src="http://127.0.0.1/Hades/img/artwork/picture/<?php echo $_s['img']; ?>">
				<div>
					<h2 class="black"><?php echo $_s['title']; ?></h2>
					<p class="black description-content"><?php echo $_s['description'];?></p>
				</div>
			</div>
<!-- 		<div id="aw" style="background-image: url('../img/artwork/picture/<?php if('' !== $_s['img']){
																	echo $_s['img'];									
																}
																else{
																	echo 'back.jpeg';
																}?>');">
			<h2><?php echo $_s['title'];?></h2>
		</div> -->
			<?php
			}
			?>
		<article class="row artwork-row">
			<?php
			while($s = mysqli_fetch_assoc($select)){
			?>
			<div class="col-md-4">
				<div class="card mb-4 shadown-sm

				<?php 
				if(!isset($_COOKIE['color']) || $_COOKIE['color'] == 1){
					echo "bg-light";
				}
				else{	
					echo "bg-dark";
				}?>"
				>
					<div class="card-body">
						<p><?php echo $s['title'];?></p>
						<p><?php echo $s['chapter_name']; ?></p>
						<a class="btn btn-block btn-outline-secondary" onclick="location.href='http://127.0.0.1/Hades/page/chapter.php?chapter=<?php echo $s['id_chapter'];?>'"><i class="fas fa-eye"></i></a>
					</div>
				</div>
			</div>
			<?php
			}
		}
		else{
			header("Location: ../index.php");
		}
		?>
		</article>	
	</section>
</main>
	<?php require_once('../footer.php');?>
</body>
</html>