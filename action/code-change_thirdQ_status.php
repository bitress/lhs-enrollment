<?php
include '../connect.php';

$sy_id = $_GET['sy_id'];
$thirdQ_status = $_GET['thirdQ_status'];

$query = "UPDATE tbl_sy SET thirdQ_status = $thirdQ_status WHERE sy_id = $sy_id";

mysqli_query($connect, $query);
header('location: ../manage_sy.php');

?>