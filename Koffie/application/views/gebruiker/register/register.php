<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
	<div class="row">
		<?php if (validation_errors()) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= validation_errors() ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if (isset($error)) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= $error ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="col-md-12">
			<div class="page-header">
				<h1>Register</h1>
			</div>
			<?= form_open() ?>
				 <div class="form-group">
					<label for="gebruikersnaam">Username</label>
					<input type="text" class="form-control" id="Gebruikersnaam" name="gebruikersnaam" placeholder="Enter a gebruikersnaam">
					<p class="help-block">At least 4 characters, letters or numbers only</p>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
					<p class="help-block">A valid email address</p>
				</div>
				<div class="form-group">
					<label for="wachtwoord">Password</label>
					<input type="password" class="form-control" id="Wachtwoord" name="wachtwoord" placeholder="Enter a wachtwoord">
					<p class="help-block">At least 6 characters</p>
				</div>
				<div class="form-group">
					<label for="wachtwoord_confirm">Confirm wachtwoord</label>
					<input type="password" class="form-control" id="wachtwoord_confirm" name="wachtwoord_confirm" placeholder="Confirm your wachtwoord">
					<p class="help-block">Must match your wachtwoord</p>
				</div>
				<div class="form-group">
					<label for="vraag">Hoe heet je huisdier? Onthoud dit goed</label>
					<input type="text" class="form-control" id="Vraag" name="vraag" placeholder="Hoe heet je huisdier?">
					<p class="help-block">Dit heb je nodig om je wachtwoord te resetten.</p>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-default" value="Register">
				</div>
			</form>
		</div>
	</div><!-- .row -->
</div><!-- .container -->