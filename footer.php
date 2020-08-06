		<!-- Modal Plan du Site -->
		<div class="modal fade" id="pds" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				<div style="margin-left: calc(50% - 600px) !important;" class="modal-dialog dialog"  role="document">
				    <div style="width: 1200px !important;" class="modal-content">
				      	<div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Plan du Site</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
				      	</div>
				      	<img src="http://127.0.0.1/Hades/file/pds.png">
					</div>
				</div>
		</div>

		<footer>
<!-- 	<a href="#entete" class="angle-up"><i class="fas fa-angle-up"></i></a> -->
	<div class="backchild backchild-footer"></div>
	<div id="footer">
		<ul class="network">
			<li><a target="_blank" title="Facebook" alt="Facebook" href="https://www.facebook.com/profile.php?id=100019787359421&ref=bookmarks"><i class="fab fa-facebook-square"></i></a></li>
			<li><a target="_blank" title="Twitter" alt="Twitter" href="https://twitter.com/FhuNox"><i class="fab fa-twitter-square"></i></a></li>
			<li><a target="_blank" title="LinkedIn" alt="LinkedIn" href="https://www.linkedin.com/in/nadji-soulaimana-362b6a18a/"><i class="fab fa-linkedin"></i></a></li>
			<li><a target="_blank" title="Instagram" alt="Instagram" href="https://www.instagram.com/nura.naji/"><i class="fab fa-instagram-square"></i></a></li>
		</ul>
		<ul>
			<li>Contactez-moi</li>

		<?php

		$sql = 'SELECT * FROM SuperUser WHERE id_superuser = 1';
		$select = mysqli_query($cnx, $sql);

		if($s = mysqli_fetch_assoc($select)){
		?>
			<!-- <li>Prénom :<?php echo $s['firstname']; ?></li>
			<li>Nom : <?php echo $s['lastname']; ?></li> -->
			<li><a class="btn btn-warning" href="mailto:<?php echo $s['email'];?>"><i class="fas fa-envelope"></i><?php echo $s['email']; ?></a></li>
		<?php
		}
		?>
		</ul>
	</div>
	<div id="info">
		<ul>
			<li><!--<i class="far fa-copyright"></i>-->© 2020-2021</li>
			<li title="Conditions Générales d'Utilisations" alt="C.G.U"><a target="_blank" href="http://127.0.0.1/Hades/cgu.php?cgu=fr">C.G.U</a></li>
			<li><a style="cursor: pointer;" data-toggle="modal" data-target="#pds">Plan du Site</a></li>
			<li><a target="_blank" href="http://127.0.0.1/Hades/ml.php?ml=fr">Mention Légale</a></li>
		</ul>
	</div>
</footer>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script type="text/javascript" src="http://127.0.0.1/Hades/js/main.js"></script>