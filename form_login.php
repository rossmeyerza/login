<!---- AJAX Load form_login/form_register.php ---->
<div id="load">
	<div>
		<input id="login_user" class="login" type="text" required name="login_user" autocomplete="off">
		<label for="login_user" class="lgn-lbl">username</label>
	</div>
	<div>
		<input id="login_password" class="login" type="password" required name="login_password" autocomplete="off">
		<label for="login_password" class="lgn-lbl">password</label>
	</div>
	<div id="cred"><?php echo isset($_GET['credentials']) && $_GET['credentials'] === 'false' ? "wrong login details": null; ?></div>
	<input type="submit" value="login" id="lgn-btn" class="bg_btn">
	<input class="remem" type="checkbox" name="cookie" value="checked"><label for="cookie" class="remem">remember me?</label>
	<a href="#login" id="signup">register</a>
	<!---- Signup.js------>
	<script ><?php include 'compileJS/signup.min.js';?></script>
</div>
