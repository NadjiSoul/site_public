<div class="next-previous">
	<div>Chapitre <?php echo $s['chapter_name'];?></div>
					<?php
						$liste_rep = scandir('../img/artwork/'.$s['title'].'/');
						$num = count($liste_rep);

						$_sql = "SELECT Chapter.* FROM Chapter 
						INNER JOIN Artwork ON Artwork.id_artwork = Chapter.artwork_id
						WHERE Chapter.id_chapter = $chapter_id";


						for($i = 2; $i < $num; $i++){
							if($liste_rep[$i]){
								if($liste_rep[$i] == $s['chapter_name']){
									$stitle = $s['title'];
									// Button previous
									if(isset($liste_rep[$i-1]) && $liste_rep[$i-1] !== '..' && $liste_rep[$i-1] !== '.'){
										$previous = $liste_rep[$i-1];
										$_sql = "SELECT Chapter.* FROM Chapter 
												INNER JOIN Artwork ON Artwork.id_artwork = Chapter.artwork_id
												WHERE Chapter.name = '$previous'
												AND Artwork.title = '$stitle'";
										$_select = mysqli_query($cnx, $_sql);
										$_s = mysqli_fetch_assoc($_select);
									?>
										<button class="btn btn-secondary" onclick="location.href='http://127.0.0.1/Hades/page/chapter.php?chapter=<?php echo $_s['id_chapter'];?>'">Précedent<!-- <?php echo $_s['name'];?> --></button>
									<?php
									}
									// Button next
									if(isset($liste_rep[$i+1])){
										$next = $liste_rep[$i+1];
										$_sql = "SELECT Chapter.* FROM Chapter 
												INNER JOIN Artwork ON Artwork.id_artwork = Chapter.artwork_id
												WHERE Chapter.name = '$next'
												AND Artwork.title = '$stitle'";
										$_select = mysqli_query($cnx, $_sql);
										$_s = mysqli_fetch_assoc($_select);
									?>
										<button class="btn btn-secondary" onclick="location.href='http://127.0.0.1/Hades/page/chapter.php?chapter=<?php echo $_s['id_chapter'];?>'">Suivant<!-- <?php echo $_s['name'];?> --></button>
									<?php
												
									}
								}
							}	
						}
						?>
</div>