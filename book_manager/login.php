<?php include '../view/header.php'; ?>

<main class="container">

	<a href="?action=register" title="Add a Book">Register</a>

	<form method="post" action="index.php">
		<h1 class="login-title">Log In</h1>
		<div class="fieldset-box">
		<fieldset class="form-group">
			<label for="username" class="col-sm-2">Username</label>
			<input name="username" required />
		</fieldset>
	</div>
	<div class="fieldset-box">
		<fieldset class="form-group">
			<label for="password" class="col-sm-2">Password</label>
			<input name="password" required type="password" />
		</fieldset>
	  </div>
	  <input type="hidden" name="action" value="validate" />
		<button type="submit" class="login-btn">Log In</button>
	</form>

</main>


<?php include '../view/footer.php'; ?>
