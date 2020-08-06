<?php require_once('./header.php');
	if(isset($_SESSION['id_superuser'])){
	?>
	<button class="btn btn-secondary" onclick="location.href='http://127.0.0.1/Hades/admin/index.php?click=0'">Oeuvre</button>
	<button class="btn btn-secondary" onclick="location.href='http://127.0.0.1/Hades/admin/index.php?click=1'">Chapitre</button>
	<?php
		$sql = "SELECT COUNT(*) FROM Chapter WHERE report = 1";
		$select = mysqli_query($cnx, $sql);

	?>
	<button class="btn btn-secondary" onclick="location.href='http://127.0.0.1/Hades/admin/page/chapter_report.php'">Oeuvre signalée
		<span>
		<?php 
		if($s = mysqli_fetch_assoc($select)){
				echo $s['COUNT(*)'];
		}?>
		</span>
	</button>
	<table class="table table-striped table-sm">
	<?php
		$user = $_SESSION['id_superuser'];	
		if(!isset($_GET['click']) || $_GET['click'] == 0){
			$sql = "SELECT * FROM Artwork";
		} 
		else{
			$sql = "SELECT Chapter.*, Artwork.title AS artwork_title FROM Chapter
			INNER JOIN Artwork
			WHERE Chapter.artwork_id = Artwork.id_artwork
			AND Chapter.report = 0
			ORDER BY id_chapter DESC";
		}           
		$select = mysqli_query($cnx, $sql);
		while($s = mysqli_fetch_assoc($select)){
		?>
		<tr>
			<?php 
			if(!isset($_GET['click']) || $_GET['click'] == 0){
			?>
			<td><?php echo $s['title'];?></td>
			<td><?php echo $s['id_artwork'];?></td>
			<td>
				<button  class="btn btn-info" onclick="location.href='http://127.0.0.1/Hades/page/artwork.php?artwork=<?php echo $s['id_artwork'];?>'">Show Episodes</button>
				<button class="btn btn-warning" onclick="location.href=''">Signaler l'oeuvre</button>
				<button class="btn btn-danger">Supprimer</button>
			</td>
			<?php
			}
			else{
			?>
			<td><?php echo $s['name'];?></td>
			<td><?php echo $s['id_chapter'];?></td>
			<td><?php echo $s['artwork_title'];?></td>
			<td><button  class="btn btn-info" onclick="location.href='http://127.0.0.1/Hades/page/chapter.php?chapter=<?php echo $s['id_chapter'];?>'">Show Episodes</button>
				<button class="btn btn-warning" onclick="location.href='http://127.0.0.1/Hades/admin/page/treatment/post_report.php?chapter=<?php echo $s['id_chapter'];?>'">Signaler le chapitre</button>
				<button class="btn btn-danger">Supprimer</button>
			</td>
			<?php
			}
			?>
		</tr>
		<?php
		}
	}
	else{
		header('Location: ./page/user.php');
	}
	?>
	</table>
<?php require_once('./footer.php');?>
</body>
</html>