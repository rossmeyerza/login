<?php 

define("CONN", "localhost");
define("DATABASE", "sanofi");
define("USER", "root");
define("PASSWORD", "t5t5t5");


$con= new mysqli(CONN,USER,PASSWORD,DATABASE);
if ($con->connect_error)
{
	exit("Failed to connect to MySQL: " .$con->connect_error);
};?>