<?php  

include '../connect.php';

if(isset($_POST['save_attendance']))
{
    $student_id = $_POST['student_id'];
    $sql="SELECT t1.*, CONCAT(t3.fname, ' ', LEFT(t3.mname, 1), '. ', t3.lname, ' ', t3.extension) AS 'student_name', t4.month
            FROM tbl_attendance AS t1
            INNER JOIN tbl_enrollment AS t2 ON t2.enrollment_id = t1.enrollment_id
            INNER JOIN tbl_student AS t3 ON t3.student_id = t2.student_id
            INNER JOIN tbl_month AS t4 ON t4.month_id = t1.month_id
            WHERE t3.student_id = $student_id";
    $result=mysqli_query($connect,$sql);
    echo $student_id;
    /* Count table rows */
    $count=mysqli_num_rows($result);
        
        for($i=0;$i<$count;$i++){
        $sql1="UPDATE tbl_attendance SET schoolDays='" . $_POST['schoolDays'][$i] . "', daysPresent='" . $_POST['daysPresent'][$i] . "', daysAbsent='" . $_POST['daysAbsent'][$i] . "'  WHERE attendance_id='" . $_POST['attendance_id'][$i] . "'";
        $result1=mysqli_query($connect,$sql1);
        }
        if($result1)
        {
            $res = [
                'status' => 200,
                'message' => 'Attendance Entered Successfully'
            ];
            echo json_encode($res);
            return;
        }
}
 
?>