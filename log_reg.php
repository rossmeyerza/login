<?php
session_start();
require 'data_connect.php';

if (empty($_SESSION['login_user']) && empty($_COOKIE['login_user']) ){
   		
   	// checking login

   	if(empty($_POST['sign_user']) && isset($_POST['login_user'])) {

   		//capture variables

		$user  = strtolower($_POST['login_user']);
		

		//prepare statement

		if($query = $con->prepare("SELECT `password`, `user`, `name`, `pid` FROM `login_user` WHERE `user` = ?")) {
			$query->bind_param('s', $user);

			$query->execute();
			$query->store_result();
			$query->bind_result($pass, $use, $name, $pid);
			$query->fetch();

			if ($use !== $user) {
				exit(header ('location: /?credentials=no_user'));
			};

			$password = ($_POST['login_password']);

			if (password_verify($password, $pass)){					
				$_SESSION['login_user'] = $use;
				$_SESSION['login_name'] = $name;
				$_SESSION['pid'] = $pid;

				if (isset($_POST['cookie'])) {
					setcookie('login_user', $use, time()+ 3600, '/');
					setcookie('login_name', $name, time()+ 3600, '/');
				};

				header('location: /dashboard/');

			} else {
				exit(header('location: /?credentials=false'));
			};
			$query->close();
		} else {
			exit("Error: ".$con->error);
		};
	};


	//creating new user
	if (empty($_POST['login_user']) && isset($_POST['sign_user'])) {

		//capture user information

		$user  = strtolower($_POST['sign_user']);
		$password = password_hash($_POST['sign_password'],PASSWORD_DEFAULT);

		//validate email address first:
		$email = $_POST['sign_email'];

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    		exit(header('location: /?email=false'));

		};

		//create a prepared statement
		if ($result = $con->query("SELECT `user`, `email` FROM `login_user`")) {
			while($row = $result->fetch_assoc()) {
				
				if ($row['user'] == $user || $row['email'] == $email) {
					exit(header('location: /?user=alreadyInUse'));
				}

			};
		} else {
			exit("Error: ".$con->error);
		}
		if ($query = $con->prepare("INSERT INTO login_user ( `user`, `name`, `password`, `email`, `profile`) VALUES ( ?, 'guest', ?, ?, 'guest.png')")) {
			$query->bind_param('sss',$user, $password, $email);
			$query->execute();
			$query->close();
			$_SESSION['login_user'] = $user;
			$_SESSION['login_name'] = 'guest';

			header('location: /?firstCapture');
		} else {
			exit("Error: ".$con->error);
		};
	};
};
?>