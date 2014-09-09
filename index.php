<?php 
$document = 'login';
session_start();
if (isset($_SESSION['login_user']) || isset($_COOKIE['login_user'])){
	header('location: /dashboard/welcome/');
	};
include 'head.php';?>
<img  id="logo" src="images/drawing.png">
<form id="login_form" method="post" action="log_reg.php">
 	<?php 	include 'form_login.php';?>
</form>
</body>
</html>