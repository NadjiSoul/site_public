<?php 

session_start();
require_once('../header.php'); 
require_once('./treatment/contact_treatment.php');

?>
	<form id="form_contact" method="POST">
		<div class="form-contact">
			<div>
				<div class="form-group">
					<label for="firstname" class="white">Prénom<span>*</span></label>
						<input id="firstname" class="form-control" type="text" name="firstname" value="<?php
						if(isset($_SESSION['f'])){
							echo $_SESSION['f'];
							unset($_SESSION['f']);
						}?>">
				</div>
				<div class="form-group">
					<label for="lastname" class="white">Nom<span>*</span></label>
						<input id="lastname" class="form-control" type="text" name="lastname"alue="<?php
						if(isset($_SESSION['l'])){
							echo $_SESSION['l'];
							unset($_SESSION['l']);
						}?>">
				</div>
				<div class="form-group">
					<label for="email" class="white">Email<span>*</span></label>
					<input  id="email" class="form-control" type="text" name="email" value="<?php
						if(isset($_SESSION['e'])){
							echo $_SESSION['e'];
							unset($_SESSION['e']);
						}?>">
				</div>
				<div class="form-group">
					<label for="tel" class="white">Telephone</label>
						<input id="tel" class="form-control" type="text" name="tel" value="<?php
						if(isset($_SESSION['t'])){
							echo $_SESSION['t'];
							unset($_SESSION['t']);
						}?>">
				   	<small id="emailHelp" class="form-text text-muted">We'll never share your datas with anyone else.</small>
				</div>
			</div>
			<div>
				<div class="form-group">
						<label for="subject" class="white">Sujet<span>*</span></label>
						<input id="subject" class="form-control" type="text" name="subject" value="<?php
						if(isset($_SESSION['s'])){
							echo $_SESSION['s'];
							unset($_SESSION['s']);
						}?>">
				</div>
				<div class="form-group">
					<label for="message" class="white">Message<span>*</span></label>
					<textarea id="message" class="form-control" rows=9 name="message"><?php
						if(isset($_SESSION['m'])){
							echo $_SESSION['m'];
							unset($_SESSION['m']);
						}?></textarea>
				</div>
			</div>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="send"><i class="fas fa-paper-plane"></i></button>
	</form>
	<!-- <img src="../img/white/email.svg" width="50" style="margin: 30px 0 30px calc(50% - 25px);"> -->
</main>
<?php require_once('../footer.php');?>
</body>
</html>