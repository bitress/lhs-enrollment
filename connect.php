<?php

	//creating connection
	// $connect = new mysqli("localhost", "ispscta6_enrollmentlhs", "!JI~*j?FKx]*", "ispscta6_db_enrollment2");

	$connect = new mysqli("localhost", "root", "", "ispscta6_db_enrollment2");
	//check connection
	if ($connect->connect_error) {
		die("Connection Failed: " . $connect->connect_error);
	}

?>