<?php
include '../connect.php';

$sy_id = $_GET['sy_id'];
$fourthQ_status = $_GET['fourthQ_status'];

$query = "UPDATE tbl_sy SET fourthQ_status = $fourthQ_status WHERE sy_id = $sy_id";

mysqli_query($connect, $query);
header('location: ../manage_sy.php');

?>