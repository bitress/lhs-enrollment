<?php
include '../connect.php';

$sy_id = $_GET['sy_id'];
$firstQ_status = $_GET['firstQ_status'];

$query = "UPDATE tbl_sy SET firstQ_status = $firstQ_status WHERE sy_id = $sy_id";

mysqli_query($connect, $query);
header('location: ../manage_sy.php');

?>