<?php
include '../connect.php';

$sy_id = $_GET['sy_id'];
$sy_status = $_GET['sy_status'];

$query = "UPDATE tbl_sy SET sy_status = $sy_status WHERE sy_id = $sy_id";

mysqli_query($connect, $query);
header('location: ../manage_sy.php');

?>