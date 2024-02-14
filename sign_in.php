<?php
	
	session_start();
	include_once 'connect.php';

	//Log in
	if (isset($_POST['login'])) {

		$username = $_POST['username'];
		$password = $_POST['password']; 
		$userType = $_POST['userType']; 

		//protect from sql injection
		$username = stripcslashes($username);
		$password = stripcslashes($password);

		$username = mysqli_real_escape_string($connect, $username);
		$password = mysqli_real_escape_string($connect, $password);

		$query = "SELECT * FROM tbl_faculty WHERE BINARY username='$username'";
		$result = mysqli_query($connect, $query);

			if (mysqli_num_rows($result) > 0 ){
						
				while ($row = mysqli_fetch_array($result)){

					if ($password == $row['password']){
						if ($row['userType'] == "admin") {
							$_SESSION['faculty_id'] = $row['faculty_id'];
							$_SESSION['userType'] = $row['userType'];
							$_SESSION['username'] = $username;
							header("Location: index.php"); 
						} else if ($row['userType'] == "co_admin") {
							$_SESSION['faculty_id'] = $row['faculty_id'];
							$_SESSION['userType'] = $row['userType'];
							$_SESSION['username'] = $username;
							header("Location: index.php"); 
						} else if ($row['userType'] == "cashier") {
							$_SESSION['faculty_id'] = $row['faculty_id'];
							$_SESSION['userType'] = $row['userType'];
							$_SESSION['username'] = $username;
							header("Location: index.php"); 
						}
					} else{
						$_SESSION['status'] = "Incorrect username or password";
						$_SESSION['status_icon'] = "error";
						header("location: login.php");
		 
					}

				}

			} else{

				$_SESSION['status'] = "Could not find your account!";
				$_SESSION['status_icon'] = "error";
				header("location: login.php");

			}

	}

?>