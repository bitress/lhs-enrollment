<?php
session_start();
include 'connect.php';
// include autoloader
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// sql 
$enrollment_id = $_GET['enrollment_id'];
$query = "SELECT t1.*, t2.student_id, t2.lrn, t2.fname, t2.mname, t2.lname, t2.extension, t2.gender, t2.birthdate, CURDATE(), TIMESTAMPDIFF(YEAR, t2.birthdate, CURDATE()) as age, t2.prevschool, t2.address, t2.pbirth, t2.cnumber, t2.schoolYear, t2.f_fname, t2.f_mname, t2.f_lname, t2.f_extension, t2.f_occupation, t2.m_fname, t2.m_mname, t2.m_lname, t2.m_extension, t2.m_occupation, t2.status, t3.*, t4.*, t5.*
    FROM tbl_enrollment AS t1
          INNER JOIN tbl_student AS t2 ON t2.student_id = t1.student_id
          INNER JOIN tbl_student_subject AS t3 ON t3.student_id = t1.student_id
          INNER JOIN tbl_offered_subject AS t4 ON t4.offered_subject_id = t3.offered_subject_id
          INNER JOIN tbl_subject AS t5 ON t5.subject_id = t4.subject_id
          WHERE t1.enrollment_id = $enrollment_id";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
$filename = $row['lname'];

// instantiate and use the dompdf class
$dompdf = new Dompdf();
ob_start();
require('printing_content.php');
$html = ob_get_contents();
ob_get_clean();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($filename.'_Enrollment-Form.pdf', ['Attachment'=>false]);

?>