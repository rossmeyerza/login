<!---- AJAX Load form_login/form_register.php ---->
<div id="load">	
	<div>
		<input id="login_user" class="login" type="text" required name="sign_user" autocomplete="off">
		<label for="login_user" class="lgn-lbl">username</label>
	</div>
	<div>
		<input id="login_password" class="login" type="password" required name="sign_password" autocomplete="off">
		<label for="login_password" class="lgn-lbl">password</label>
	</div>
	<div id="confirm">
		<input id="login_confirm" class="login" type="password" required name="sign_confirm" autocomplete="off">
		<label for="login_confirm" class="lgn-lbl">confirm password</label>
	</div>
	<div id="match">password does not match</div>
	<div id="email">
		<input id="login_email" class="login" type="email" required name="sign_email" autocomplete="off">
		<label for="login_confirm" class="lgn-lbl">email</label>
	</div>	
	<input type="submit" value="register" id="lgn-btn" class="bg_btn">
	<a href="#sign" id="login-btn">login</a>
	<!------ login.js ------>
	<script ><?php include 'compileJS/login.min.js';?></script>
</div>