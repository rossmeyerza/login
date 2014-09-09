<?php 

/*---- set time zone ----*/
date_default_timezone_set("UTC");
/*---BEGIN login creditials and checking---*/

$host = explode("/",$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);

// always connect to database once
require_once 'data_connect.php';

/************************************************
*												*
*		has a session started?					*
*												*
************************************************/

function is_session_started() {
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}
if ( is_session_started() === FALSE ) session_start();


if (empty($_SESSION['login_user'])) {
	header('location: /');
}



/************************************************
*												*
*		creating variables						*
*												*
************************************************/


	$welcome = "Welcome <span id='name'>".$_SESSION['login_name']."</span";

/*---END login creditials and checking---*/
?>
