<?php

require('../header.php');

if(isset($_SESSION['id_superuser'])){
?>
<div class="container">
	<table class="table table-striped table-sm table-modify">
		<h2 class="white"></h2>
		<tr>
			<td>ID du chapitre</td>
			<td>Nom du chapitre</td>
			<td>Nom de l'oeuvre</td>
			<td>Action</td>
		</tr>
		<?php
		require('../../db.php');
		$sql = "SELECT Chapter.*, Artwork.title AS artwork_title FROM Chapter
		INNER JOIN Artwork 
		WHERE Chapter.artwork_id = Artwork.id_artwork
		AND Chapter.report = 1";
		$select = mysqli_query($cnx, $sql);
		while($s = mysqli_fetch_assoc($select)){
		?>
		<tr>
			<td><?php echo $s['id_chapter'];?></td>
			<td><?php echo $s['name'];?></td>
			<td><?php echo $s['artwork_title'];?></td>
			<td>
				<button class="btn btn-info" onclick="location.href='http://127.0.0.1/Hades/admin/page/treatment/post_report.php?chapter=<?php echo $s['id_chapter'];?>&active=1'">Rien à signaler</button>
				<button class="btn btn-warning" onclick="location.href='http://127.0.0.1/Hades/admin/page/treatment/post_report.php?chapter=<?php echo $s['id_chapter'];?>&active=0'">Cacher</button>
			</td>
		</tr>
		<?php
		}
		?>
	</table>
</div>

<?php
	require_once('../footer.php');
}
else{
	header('Location: ./user.php');
}
