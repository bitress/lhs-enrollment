<?php
session_start();
include 'connect.php';
require('fpdf/fpdf.php');

// Instanciation of inherited class
$pdf = new FPDF('P','mm',array(215.9,330.2));
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

// sql 1
$enrollment_id = $_GET['enrollment_id'];
$query = "SELECT t1.*, t2.student_id, t2.lrn, t2.fname, t2.mname, t2.lname, t2.extension, t2.gender, t2.birthdate, CURDATE(), TIMESTAMPDIFF(YEAR, t2.birthdate, CURDATE()) as age, t2.prevschool, t2.address, t2.pbirth, t2.cnumber, t2.schoolYear, t2.f_fname, t2.f_mname, t2.f_lname, t2.f_extension, t2.f_occupation, t2.m_fname, t2.m_mname, t2.m_lname, t2.m_extension, t2.m_occupation, t2.status, t3.*, t4.*, t5.*, t6.*
    FROM tbl_enrollment AS t1
          INNER JOIN tbl_student AS t2 ON t2.student_id = t1.student_id
          INNER JOIN tbl_student_subject AS t3 ON t3.student_id = t1.student_id
          INNER JOIN tbl_offered_subject AS t4 ON t4.offered_subject_id = t3.offered_subject_id
          INNER JOIN tbl_subject AS t5 ON t5.subject_id = t4.subject_id
          INNER JOIN tbl_grade_level AS t6 ON t6.grade_level_id = t1.grade_level_id
          WHERE t1.enrollment_id = $enrollment_id";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);

//$pdf->Cell(0,10,$row['lname'],0,1);

//==== Header ====//
// Logo Image('img name',x,y,size);
$pdf->Image('img/img2.png',12,11,33);
    
// Move to the right // Title
$pdf->Ln(0);

$pdf->Cell(157);
$pdf->SetFont('Times','B',12);
$pdf->Cell(38,38,"2'x2' ID Picture",1,0,'C');
$pdf->Cell(160);
$pdf->Cell(35,35,'',1,0);
$pdf->Cell(35);
$pdf->Cell(100,0,'',0,1);

$pdf->Ln(2);

$pdf->SetFont('Times','',12);
$pdf->Cell(38);
$pdf->Cell(100,2,'ILOCOS SUR POLYTECHNIC STATE COLLEGE',0,1);

$pdf->Cell(38);
$pdf->SetFont('Times','B',12);
$pdf->Cell(100,10,'LABORATORY HIGH SCHOOL',0,1);
$pdf->SetFont('Times','',12);
$pdf->Cell(38);
$pdf->Cell(100,2,'Tagudin, Ilocos Sur',0,1);

$pdf->Ln(15);
$pdf->SetFont('Times','B',12);
$pdf->Cell(45);
$pdf->Cell(100,2,'ENROLLMENT FORM',0,1,'C');

// Line break
$pdf->Ln(8);
//==== Header ====//

//==== TOP ===//
//top part line 1
$pdf->Ln(0);
$pdf->SetFont('Times','I',11);
$pdf->Cell(65,5,'School Copy/ Student Copy Number',0,0);
$pdf->Cell(30,5,'','B',0);
$pdf->Cell(33);
$pdf->Cell(27,5,'Studuent Type:',0,0);
$pdf->Cell(10,5,'','B',0);
$pdf->Cell(10,5,'Old',0,0);
$pdf->Cell(10,5,'','B',0);
$pdf->Cell(10,5,'New',0,1);

//top part line 2
$pdf->Ln(2);
$pdf->SetFont('Times','I',11);
$pdf->Cell(37,5,'Date of Registration',0,0);
$pdf->Cell(58,5,'','B',0);
$pdf->Cell(33);
$pdf->Cell(27,5,'Grade Level:',0,0);
$pdf->Cell(38,5,'','B',0);

//top part line 3
$pdf->Ln(7);
$pdf->SetFont('Times','I',11);
$pdf->Cell(25,5,'','B',0);
$pdf->Cell(17,5,'Semester',0,0);
$pdf->Cell(8);
$pdf->Cell(23,5,'School Year:',0,0);
$pdf->Cell(21,5,'','B',0);

//border line
$pdf->Ln(10);
//$pdf->SetLineWidth(1);
$pdf->Line(10,72,205,72);
//==== TOP ===//

//==== MID 1 ===//
//mid 1 part 1
$pdf->Ln(1);
$pdf->SetFont('Times','BI',11);
$pdf->Cell(36,5,'REQUIRED FORMS',0,0);
$pdf->Cell(34,5,'(Check if available)',0,0);

$pdf->Ln(6);
$pdf->SetFont('Times','I',11);
$pdf->Cell(36,5,'Photocopy of:',0,1);
$pdf->Ln(1);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'Form 137-E',0,0);
$pdf->Cell(70);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'Form 138 (Report Card)',0,0);
$pdf->Ln(6);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'PSA Birth Certificate',0,0);
$pdf->Cell(70);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'Cetrtificate of Good Moral Character',0,0);

$pdf->Ln(8);
$pdf->SetFont('Times','I',11);
$pdf->Cell(36,5,'Others:',0,1);
$pdf->Ln(1);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'2 (2x2) ID Picture (White Background)',0,0);
$pdf->Cell(70);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'Clearance (Old Students)',0,0);
$pdf->Ln(6);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'long expanded envelope',0,1);

//border line
$pdf->Ln(3);
//$pdf->SetLineWidth(1);
$pdf->Line(10,121,205,121);

//mid 1 part 2
//$pdf->Ln(3);
$pdf->SetFont('Times','I',11);
$pdf->Cell(36,5,'Please fill-up the needed information#',0,0);

$pdf->Ln(6);
$pdf->SetFont('Times','I',11);
$pdf->Cell(107,5,'Grade Level',0,0);
if ($row['grade_level'] == 'Grade 11' || $row['grade_level'] == 'Grade 12') {
$pdf->SetFont('Times','BI',11);
$pdf->Cell(46,5,'For SHS only: Grade Level',0,0);
$pdf->SetFont('Times','B',11);
$pdf->Cell(17,5,$row['grade_level'],'B',1);
$pdf->Ln(1);
} else {
$pdf->SetFont('Times','BI',11);
$pdf->Cell(46,5,'For SHS only: Grade Level',0,0);
$pdf->SetFont('Times','B',11);
$pdf->Cell(17,5,'','B',1);
$pdf->Ln(1);
}
if ($row['grade_level'] == 'Grade 7') {
$pdf->SetFont('Times','',11);
$pdf->Image('img/check.png',15,134,5);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'Grade 7',0,0);
} else {
$pdf->SetFont('Times','',11);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'Grade 7',0,0);
}
$pdf->Cell(70);
$pdf->SetFont('Times','BI',11);
//$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'Academic Track',0,0);
$pdf->Ln(6);
if ($row['grade_level'] == 'Grade 8') {
$pdf->SetFont('Times','',11);
$pdf->Image('img/check.png',15,140,5);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'Grade 8',0,0);
} else {
$pdf->SetFont('Times','',11);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'Grade 8',0,0);
}
if ($row['section'] == 'STEM') {
$pdf->Cell(70);
$pdf->SetFont('Times','',11);
$pdf->Image('img/check.png',123,140,5);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'STEM',0,0);
} else {
$pdf->Cell(70);
$pdf->SetFont('Times','',11);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'STEM',0,0);
}
$pdf->Ln(6);
if ($row['grade_level'] == 'Grade 9') {
$pdf->SetFont('Times','',11);
$pdf->Image('img/check.png',15,146,5);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'Grade 9',0,0);
} else {
$pdf->SetFont('Times','',11);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'Grade 9',0,0);
}
if ($row['section'] == 'ABM') {
$pdf->Cell(70);
$pdf->SetFont('Times','',11);
$pdf->Image('img/check.png',123,146,5);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'ABM',0,0);
} else {
$pdf->Cell(70);
$pdf->SetFont('Times','',11);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'ABM',0,0);
}
$pdf->Ln(6);
if ($row['grade_level'] == 'Grade 10') {
$pdf->SetFont('Times','',11);
$pdf->Image('img/check.png',15,152,5);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'Grade 10',0,0);
} else {
$pdf->SetFont('Times','',11);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'Grade 10',0,0);
}
if ($row['section'] == 'HUMSS') {
$pdf->Cell(70);
$pdf->SetFont('Times','',11);
$pdf->Image('img/check.png',123,152,5);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'HUMSS',0,0);
} else {
$pdf->Cell(70);
$pdf->SetFont('Times','',11);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(23,5,'HUMSS',0,0);
}

//border line
$pdf->Ln(3);
//$pdf->SetLineWidth(1);
$pdf->Line(10,159,205,159);

//mid 2
$pdf->Ln(5);
$pdf->SetFont('Times','BI',11);
$pdf->Cell(36,5,'PERSONAL INFORMATION',0,1);

$pdf->Ln(0);
$pdf->Cell(15);
$pdf->SetFont('Times','',11);
$pdf->Cell(26,5,'Email Address:',0,0);
$pdf->Cell(100,5,'','B',1);
$pdf->Ln(1);
$pdf->Cell(15);
$pdf->Cell(11,5,'LRN:',0,0);
$pdf->Cell(115,5,strtoupper($row['lrn']),'B',1);
$pdf->Ln(1);
$pdf->Cell(15);
$pdf->Cell(26,5,'Last Name:',0,0);
$pdf->Cell(100,5,strtoupper($row['lname']),'B',1);
$pdf->Ln(1);
$pdf->Cell(15);
$pdf->Cell(26,5,'First Name:',0,0);
$pdf->Cell(100,5,strtoupper($row['fname']),'B',1);
$pdf->Ln(1);
$pdf->Cell(15);
$pdf->Cell(26,5,'Middle Name:',0,0);
$pdf->Cell(100,5,strtoupper($row['mname']),'B',1);
$pdf->Ln(1);
$pdf->Cell(15);
$pdf->Cell(11,5,'Age:',0,0);
$pdf->Cell(15,5,strtoupper($row['age']),'B',1);
$pdf->Ln(1);
$pdf->Cell(15);
$pdf->Cell(11,5,'Sex:',0,0);
$pdf->Ln(2);
if ($row['gender'] == 'Male') {
$pdf->Image('img/check.png',40,203,5);
}
$pdf->Cell(25);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(11,5,'Male',0,0);
$pdf->Ln(6);
if ($row['gender'] == 'Female') {
$pdf->Image('img/check.png',40,209,5);
}
$pdf->Cell(25);
$pdf->Cell(15,5,'','B',0);
$pdf->Cell(11,5,'Female',0,0);
$pdf->Ln(7);
$pdf->Cell(15);
$pdf->Cell(16,5,'Address:',0,0);
$pdf->Cell(110,5,strtoupper($row['address']),'B',1);
$pdf->Ln(1);
$pdf->Cell(15);
$pdf->Cell(43,5,'Date of Birth (mm/dd/yy):',0,0);
$pdf->Cell(83,5,strtoupper($row['birthdate']),'B',1);
$pdf->Ln(1);
$pdf->Cell(15);
$pdf->Cell(25,5,'Place of Birth:',0,0);
$pdf->Cell(101,5,strtoupper($row['pbirth']),'B',1);
$pdf->Ln(1);
$pdf->Cell(15);
$pdf->Cell(29,5,'Contact Number:',0,0);
$pdf->Cell(97,5,strtoupper($row['cnumber']),'B',1);
$pdf->Ln(1);
$pdf->Cell(15);
$pdf->Cell(29,5,'Name of Father (Last Name, First Name, Middle Name):',0,1);
$pdf->Cell(16);
$pdf->Cell(110,5,strtoupper($row['f_lname']).","." ".strtoupper($row['f_fname'])." ".strtoupper($row['f_extension'])." ".strtoupper($row['f_mname']),'B',1);
$pdf->Ln(1);
$pdf->Cell(15);
$pdf->Cell(35,5,'Occupation of Father:',0,0);
$pdf->Cell(91,5,strtoupper($row['f_occupation']),'B',1);
$pdf->Ln(1);
$pdf->Cell(15);
$pdf->Cell(29,5,'Name of Mother (last name, First Name, Middle Name):',0,1);
$pdf->Cell(16);
$pdf->Cell(110,5,strtoupper($row['m_lname']).","." ".strtoupper($row['m_fname'])." ".strtoupper($row['m_extension'])." ".strtoupper($row['m_mname']),'B',1);
$pdf->Ln(1);
$pdf->Cell(15);
$pdf->Cell(37,5,'Occupation of Mother:',0,0);
$pdf->Cell(89,5,strtoupper($row['m_occupation']),'B',1);
$pdf->Ln(1);
$pdf->Cell(15);
$pdf->Cell(61,5,'Contact Number of Parents/Guardian:',0,0);
$pdf->Cell(65,5,'','B',1);
$pdf->Ln(1);
$pdf->Cell(15);
$pdf->Cell(48,5,'School Presently Enrolled In:',0,0);
$pdf->Cell(78,5,strtoupper($row['prevschool']),'B',1);
$pdf->Ln(1);
$pdf->Cell(15);
$pdf->Cell(22,5,'School Year:',0,0);
$pdf->Cell(104,5,strtoupper($row['schoolYear']),'B',1);
//==== MID 1 ===//

//==== BOTTOM ====//
$pdf->Ln(8);
$pdf->Cell(15);
$pdf->Cell(70,5,'','B',0);
$pdf->Cell(25);
$pdf->Cell(70,5,'','B',1);
$pdf->Cell(18);
$pdf->SetFont('Times','I',11);
$pdf->Cell(57,5,'Students Signature Over Printed Name',0,0);
$pdf->Cell(28);
$pdf->SetFont('Times','I',11);
$pdf->Cell(29,5,'Signature Over Printed Name of Parent or Guardian',0,1);

//border line
$pdf->Ln(3);
//$pdf->SetLineWidth(1);
$pdf->Line(10,313,205,313);
//==== BOTTOM ====//

//==== SUBJECTS ====//
$pdf->Cell(10);
$pdf->SetFont('Times','B',11);
$pdf->Cell(35,13,'Subject Code',1,0,'C');
$pdf->SetFont('Times','B',11);
$pdf->Cell(87,13,'Descriptive Title',1,0,'C');
$pdf->SetFont('Times','B',9);
$pdf->Cell(28,13,'No. Hours/Semester',1,0,'C');
$pdf->SetFont('Times','B',9);
$pdf->Cell(25,13,'No. Hours/Week',1,1,'C');
// sql 2 
$enrollment_id = $_GET['enrollment_id'];
$query1 = "SELECT t1.*, t2.student_id, t2.lrn, t2.fname, t2.mname, t2.lname, t2.extension, t2.gender, t2.birthdate, CURDATE(), TIMESTAMPDIFF(YEAR, t2.birthdate, CURDATE()) as age, t2.prevschool, t2.address, t2.pbirth, t2.cnumber, t2.schoolYear, t2.f_fname, t2.f_mname, t2.f_lname, t2.f_extension, t2.f_occupation, t2.m_fname, t2.m_mname, t2.m_lname, t2.m_extension, t2.m_occupation, t2.status, t3.*, t4.*, t5.*, t6.*
    FROM tbl_enrollment AS t1
          INNER JOIN tbl_student AS t2 ON t2.student_id = t1.student_id
          INNER JOIN tbl_student_subject AS t3 ON t3.student_id = t1.student_id
          INNER JOIN tbl_offered_subject AS t4 ON t4.offered_subject_id = t3.offered_subject_id
          INNER JOIN tbl_subject AS t5 ON t5.subject_id = t4.subject_id
          INNER JOIN tbl_grade_level AS t6 ON t6.grade_level_id = t1.grade_level_id
          WHERE t1.enrollment_id = $enrollment_id";
$result1 = mysqli_query($connect, $query1);
while ($row1 = mysqli_fetch_array($result1)) {
$hrsSemCount[] = $row['hrsSem'];
$hrsWeekCount[] = $row['hrsWeek'];
// Calculate the sum
(int)$hrsSemSum = array_sum($hrsSemCount);
(int)$hrsWeekSum = array_sum($hrsWeekCount);
$pdf->Cell(10);
$pdf->SetFont('Times','B',11);
$pdf->Cell(35,10,$row1['subject_code'],1,0,'C');
$pdf->SetFont('Times','B',11);
$pdf->Cell(87,10,$row1['subject_name'],1,0,'C');
$pdf->SetFont('Times','B',11);
$pdf->Cell(28,10,$row1['hrsSem'],1,0,'C');
$pdf->SetFont('Times','B',11);
$pdf->Cell(25,10,$row1['hrsWeek'],1,1,'C');
}
$pdf->Cell(10);
$pdf->SetFont('Times','B',11);
$pdf->Cell(122,10,'Total',1,0,'C');
$pdf->SetFont('Times','B',11);
$pdf->Cell(28,10,$hrsSemSum,1,0,'C');
$pdf->SetFont('Times','B',11);
$pdf->Cell(25,10,$hrsWeekSum,1,0,'C');
//==== SUBJECTS ====//

$pdf->Output();
?>