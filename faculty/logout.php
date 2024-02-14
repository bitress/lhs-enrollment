<?php  

	session_start();
	include_once 'connect.php';

	if (isset($_GET['logout'])) {

		session_destroy();
		header("location: ../login.php");
		
	}

?>