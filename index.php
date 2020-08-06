<?php 

session_start();
require_once('./header.php'); 

?>

		<section class="container">
			<article class="row">
		<?php
		if(isset($_GET['type']) || isset($_GET['category'])){
			if(isset($_GET['type'])){
				$type_id = $_GET['type'];
			}			
			if(isset($_GET['category'])){
				$category_id = $_GET['category'];
			}
			if(isset($_GET['type']) && !isset($_GET['category'])){
				$sql = "SELECT * FROM Artwork WHERE type_id = $type_id ORDER BY title ASC";
			}
			else if(!isset($_GET['type']) && isset($_GET['category'])){
				$sql = "SELECT * FROM Artwork WHERE category_id = $category_id ORDER BY title ASC";		
			}
			else if(isset($_GET['type']) && isset($_GET['category'])){
				$sql = "SELECT * FROM Artwork WHERE type_id = $type_id AND category_id = $category_id ORDER BY title ASC";
			}
		}
		else if(isset($_GET['search'])){
			$search = $_GET['search'];
			$sql = "SELECT Chapter.*, Artwork.img AS artwork_img, Artwork.title AS artwork_title FROM Chapter
			INNER JOIN Artwork ON Artwork.id_artwork = Chapter.artwork_id
			WHERE Artwork.title LIKE '%$search%'
			OR Chapter.name LIKE '%$search%'";
		}
		else{
			$sql = "SELECT Chapter.*, Artwork.img AS artwork_img, Artwork.title AS artwork_title FROM Chapter
			INNER JOIN Artwork ON Artwork.id_artwork = Chapter.artwork_id
			WHERE Chapter.active = 1
			ORDER BY id_chapter DESC";
		}
		$select = mysqli_query($cnx, $sql);

		while($s = mysqli_fetch_assoc($select)){
			?>
				<div class="col-md-4">
					<div style="overflow: hidden;" class="card mb-4 shadown-sm
					<?php 
					if(!isset($_COOKIE['color']) || $_COOKIE['color'] == 1){
						echo "bg-light";
					}
					else{	
						echo "bg-dark";
					}?>"
					>
					<div style="overflow: hidden; height: 225px;">
						<img class="bd-placeholder-img card-img-top" width="100%" 
						src="http://127.0.0.1/Hades/img/artwork/picture/<?php if(isset($s['id_artwork'])){ echo $s['img']; } else { echo $s['artwork_img'];} ?>">
					</div>
						<div class="card-body">
							<p class="card-text"><?php if(isset($s['id_artwork'])){ echo $s['title']; } else { echo $s['artwork_title']; }?></p>
							<?php if(isset($s['id_chapter'])){ ?><p class="card-text"><?php echo $s['name'];?></p><?php } ?>
							<a class="btn btn-block btn-outline-secondary" title="Voir" alt="Voir" onclick="location.href='http://127.0.0.1/Hades/page/<?php
							if(isset($s['id_artwork'])){ 
								echo "artwork.php?artwork=".$s['id_artwork'];
							}
							else if(isset($s['id_chapter'])){
								echo "chapter.php?chapter=".$s['id_chapter'];
							}
							?>'">
							<i class="fas fa-eye"></i>
							</a>
						</div>
					</div>
				</div>
		<?php
		}
		$_select = mysqli_query($cnx, $sql);
		if(empty(mysqli_fetch_assoc($_select))){
		?>
		<div><span style="color: red;">/!\ No result /!\</span></div>
		<?php
		}		
		?>
			</article>
		</section>
	</main>
	<?php require_once('./footer.php'); ?>
</body>
</html>