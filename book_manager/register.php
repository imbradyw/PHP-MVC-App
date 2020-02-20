<?php include '../view/header.php'; ?>

<main class="container">
	<h1 class="user-reg">User Registration</h1>
	<form method="post" action="index.php">
		<fieldset class="form-group">
			<label for="username" class="col-sm-2">Username</label>
			<input name="username" required />
		</fieldset>
		<fieldset class="form-group">
			<label for="password" class="col-sm-2">Password:</label>
			<input name="password" required type="password" />
		</fieldset>
		<fieldset class="form-group">
			<label for="confirm" class="col-sm-2">Confirm Password:</label>
			<input name="confirm" required type="password" />
		</fieldset>
		<input type="hidden" name="action" value="do_register" />
		<button type="submit" class="col-sm-offset-2 btn btn-success">Submit</button>
	</form>
</main>

<script src='https://www.google.com/recaptcha/api.js'></script>

<?php include '../view/footer.php'; ?>
