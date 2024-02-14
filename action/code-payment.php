<?php
include '../connect.php';

if(isset($_POST['enrollmentid']))
{

    $schoolyear = mysqli_real_escape_string($connect, $_POST['schoolyear']);
    $gradelevel = mysqli_real_escape_string($connect, $_POST['gradelevel']);
    $enrollmentid = mysqli_real_escape_string($connect, $_POST['enrollmentid']);

    $query = "SELECT 
        tbl_student.*, 
        tbl_enrollment.*,
        tbl_grade_level.grade_level
    FROM 
        tbl_enrollment
    INNER JOIN
        tbl_grade_level ON tbl_grade_level.grade_level_id = tbl_enrollment.grade_level_id
    INNER JOIN 
        tbl_student ON tbl_enrollment.student_id = tbl_student.student_id 
    WHERE   
        tbl_enrollment.enrollment_id = $enrollmentid";

    $query_run = mysqli_query($connect, $query);

    if ($query_run && mysqli_num_rows($query_run) > 0) {
        $studentData = array();
        $enrollmentData = array();

        while ($row = mysqli_fetch_assoc($query_run)) {
            $studentInfo = array(
                'student_id' => $row['student_id'],
                'lrn' => $row['lrn'],
                'fname' => $row['fname'],
                'mname' => $row['mname'],
                'lname' => $row['lname'],
                'schoolYear' => $row['schoolYear'],
                'enrollment_id' => $row['enrollment_id'],
                'grade_level_id' => $row['grade_level_id'],
                'sy_id' => $row['sy_id'],
                'date_of_enrollment' => $row['date_of_enrollment'],
                'grade_level' => $row['grade_level']
            );

            $enrollmentInfo = array(
                'enrollment_id' => $row['enrollment_id'],
                'grade_level' => $row['grade_level'],
                'date_of_enrollment' => $row['date_of_enrollment'],
                'sy_id' => $row['sy_id']
            );

            $studentData[] = $studentInfo;
            $enrollmentData[] = $enrollmentInfo;
        }


        $tuitionFeeQuery = "SELECT 
        tbl_student.lrn,
        tbl_enrollment.enrollment_id,
        tbl_student.student_id,
        tbl_student.fname,
        tbl_student.mname,
        tbl_student.lname,
        tbl_student.extension,
        t4.sy,
        tbl_grade_level.grade_level,
        GROUP_CONCAT(tbl_subject.subject_name SEPARATOR ', ') AS subjects,
        COUNT(tbl_subject.subject_id) AS num_subjects,
        SUM(tbl_offered_subject.units) AS total_units
    FROM 
        tbl_student_subject 
    INNER JOIN 
        tbl_offered_subject ON tbl_offered_subject.offered_subject_id = tbl_student_subject.offered_subject_id 
    INNER JOIN 
        tbl_subject ON tbl_subject.subject_id = tbl_offered_subject.subject_id 
    INNER JOIN 
        tbl_enrollment ON tbl_enrollment.enrollment_id = tbl_student_subject.enrollment_id 
    INNER JOIN 
        tbl_student ON tbl_student.student_id = tbl_student_subject.student_id 
    INNER JOIN 
        tbl_grade_level ON tbl_grade_level.grade_level_id = tbl_enrollment.grade_level_id 
    INNER JOIN 
        tbl_sy AS t4 ON t4.sy_id = tbl_enrollment.sy_id 
    WHERE
        tbl_enrollment.enrollment_id = '$enrollmentid'
    GROUP BY 
        tbl_student.student_id;";

        $tuitionFeeQuery_run = mysqli_query($connect, $tuitionFeeQuery);

        if ($tuitionFeeQuery_run && mysqli_num_rows($tuitionFeeQuery_run) > 0) {
            $r = mysqli_fetch_assoc($tuitionFeeQuery_run);
                $tuitionFeePayment = $r['total_units'] * 150;
        }


        $paymentQuery = "SELECT * FROM tbl_payments WHERE enrollment_id = '$enrollmentid' AND schoolyear = '$schoolyear'";
        $paymentQuery_run = mysqli_query($connect, $paymentQuery);
        $totalPayment = 0;
        if ($paymentQuery_run && mysqli_num_rows($paymentQuery_run) > 0) {

            while ($res = mysqli_fetch_assoc($paymentQuery_run)) {
                $totalPayment += $res['payment'];
            }
        }
        $feesQuery = "SELECT * FROM tbl_fee WHERE gradelevel = '$gradelevel' AND schoolyear = '$schoolyear'";
        $feesQuery_run = mysqli_query($connect, $feesQuery);
        $balance = 0;

        if ($feesQuery_run && mysqli_num_rows($feesQuery_run) > 0) {
            $feesData = array();

            while ($row = mysqli_fetch_assoc($feesQuery_run)) {
                $balance += $row['collect'];
            }
        }
        $totalBalance =  ($tuitionFeePayment + $balance)  - $totalPayment;


        $res = array(
            'status' => 200,
            'message' => 'Payment Fetch Successfully by id',
            'student_info' => $studentData,
            'enrollment_info' => $enrollmentData,
            "totalBalance" => $totalBalance
        );
        echo json_encode($res);
        return;
    } else {
        $res = array(
            'status' => 404,
            'message' => 'Course Id Not Found'
        );
        echo json_encode($res);
        return;
    }
}
else if(isset($_POST['save_payment']))
{
    $enrollment_id = mysqli_real_escape_string($connect, $_POST['enrollment_id']);
    $schoolyear = mysqli_real_escape_string($connect, $_POST['schoolyear']);

          $or_number = mysqli_real_escape_string($connect, $_POST['ORNumber']);
          $dateProcess = mysqli_real_escape_string($connect,  $_POST['dateProcess']);
        $payment = mysqli_real_escape_string($connect, $_POST['studentPayment']);

        //sql query for enrollment
        $query = "INSERT INTO `tbl_payments` (`enrollment_id`, `or_number`, `payment`, `datetime`, `schoolyear`) VALUES ('$enrollment_id', '$or_number', '$payment', '$dateProcess', '$schoolyear')";
        $query_run = mysqli_query($connect, $query);



        if($query_run)
        {
            $res = [
                'status' => 200,
                'message' => 'Student Payment Successfully'
            ];
            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 500,
                'message' => 'Payment Failed'
            ];
            echo json_encode($res);
            return;
        }


}

?>