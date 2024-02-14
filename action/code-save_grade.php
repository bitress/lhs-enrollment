<?php  

include '../connect.php';

if(isset($_POST['save_grade']))
{
    $student_id = $_POST['student_id'];
    $sql="SELECT t1.*, t2.enrollment_id, t8.fname, t8.mname, t8.lname, t8.extension, t8.lrn, t8.gender, t3.offered_subject_id, t5.subject_name, t7.grade_level_section, t6.sy
        FROM tbl_grade AS t1
        INNER JOIN tbl_enrollment AS t2 ON t2.enrollment_id = t1.enrollment_id
        INNER JOIN tbl_offered_subject AS t3 ON t3.offered_subject_id = t1.offered_subject_id
        INNER JOIN tbl_faculty AS t4 ON t4.faculty_id = t3.faculty_id
        INNER JOIN tbl_subject AS t5 ON t5.subject_id = t3.subject_id
        INNER JOIN tbl_sy AS t6 ON t6.sy_id = t3.sy_id
        INNER JOIN tbl_grade_level AS t7 ON t7.grade_level_id = t3.grade_level_id
        INNER JOIN tbl_student AS t8 ON t8.student_id = t2.student_id
        WHERE t2.student_id = $student_id";
    $result=mysqli_query($connect,$sql);
    echo $student_id;
    /* Count table rows */
    $count=mysqli_num_rows($result);
        
        for($i=0;$i<$count;$i++){
        $sql1="UPDATE tbl_grade SET firstQ='" . $_POST['firstQ'][$i] . "', secondQ='" . $_POST['secondQ'][$i] . "', thirdQ='" . $_POST['thirdQ'][$i] . "', fourthQ='" . $_POST['fourthQ'][$i] . "', remarks='" . $_POST['remarks'][$i] . "'  WHERE grade_id='" . $_POST['grade_id'][$i] . "'";
        $result1=mysqli_query($connect,$sql1);
        }
        if($result1)
        {
            $res = [
                'status' => 200,
                'message' => 'Grade Entered Successfully'
            ];
            echo json_encode($res);
            return;
        }
}
 
?>