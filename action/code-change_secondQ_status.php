<?php
include '../connect.php';

$sy_id = $_GET['sy_id'];
$secondQ_status = $_GET['secondQ_status'];

$query = "UPDATE tbl_sy SET secondQ_status = $secondQ_status WHERE sy_id = $sy_id";

mysqli_query($connect, $query);
header('location: ../manage_sy.php');

?>