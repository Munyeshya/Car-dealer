<?php 
require_once ('session_helper.php');
if (isset($_SESSION['name'] ) && isset($_SESSION['pass']) ) {

	unset($_SESSION["name"]);
    unset($_SESSION["pass"]);
	session_destroy();
	session_write_close();
	header("location:login.php");
}

 ?>