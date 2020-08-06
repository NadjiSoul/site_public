<?php require('../header.php'); ?>
<main>
	<table>
	<?php
	if(isset($_SESSION['id_superuser'])){
		if(isset($_GET['artwork'])){
			require('../../db.php');
			$artwork = $_GET['artwork'];
			$sql = "SELECT * FROM Chapter WHERE artwork_id = $artwork";
			$select = mysqli_query($cnx, $sql);
			while($s = mysqli_fetch_assoc($select)){
			?>
			<tr>
				<td><?php echo $s['name'];?></td>
				<td><button>Supprimer</button></td>
			</tr>

			<?php
			}
		}
	}
	else{
		header('Location: ./user.php');
	}
	?>
	</table>
</main>
</body>
</html>