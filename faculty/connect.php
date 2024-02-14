<?php

	//creating connection
	$connect = new mysqli("localhost", "root", "", "db_grade_management");

	//check connection
	if ($connect->connect_error) {
		die("Connection Failed: " . $connect->connect_error);
	}

?>