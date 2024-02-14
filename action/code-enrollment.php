<?php

include '../connect.php';

//enrollment
if(isset($_POST['save_enrollment']))
{
    $enrollment_id = mysqli_real_escape_string($connect, $_POST['enrollment_id']);
    $enrollment_id++;
    $student_id = mysqli_real_escape_string($connect, $_POST['student_id']);
    $grade_level_id = mysqli_real_escape_string($connect, $_POST['grade_level_id']);
    $sy_id = mysqli_real_escape_string($connect, $_POST['sy_id']);
    $date_of_enrollment = date('Y-m-d');

    if($student_id == NULL || $grade_level_id == NULL || $sy_id == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return;
    }
    $same = mysqli_query($connect, "SELECT * FROM tbl_enrollment WHERE student_id = $student_id AND grade_level_id = '$grade_level_id' AND sy_id = '$sy_id'");

    if (mysqli_num_rows($same) > 0) {

        $res = [
            'status' => 322,
            'message' => 'Student already Enrolled'
        ];
        echo json_encode($res);
        return;

    }else{
        //sql query for enrollment
        $query = "INSERT INTO tbl_enrollment (enrollment_id, student_id, grade_level_id, sy_id, date_of_enrollment) 
                VALUES ('$enrollment_id', '$student_id', '$grade_level_id', '$sy_id', '$date_of_enrollment')";
        $query_run = mysqli_query($connect, $query);

        //insert multiple rows
        function insert_into_db($data){
            foreach ($data as $key => $value) {
                $k[] = $key;
                $v[] = "'".$value."'";
            }
            $k=implode(",", $k);
            $v=implode(",", $v);


            $con=mysqli_connect("localhost", "ispscta6_enrollmentlhs", "!JI~*j?FKx]*", "ispscta6_db_enrollment2");
            $enrollment_id = mysqli_real_escape_string($con, $_POST['enrollment_id']);
            $enrollment_id++;
            $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
            $sql="INSERT INTO tbl_student_subject(enrollment_id, student_id, $k) VALUES('$enrollment_id', '$student_id', $v)";
            $run_query =mysqli_query($con,$sql);                
        }

         $query1 = "SELECT t1.subject_id, t1.subject_name
                    FROM tbl_subject AS t1
                    INNER JOIN tbl_offered_subject AS t2 ON t2.subject_id = t1.subject_id
                    INNER JOIN tbl_grade_level AS t3 ON t3.grade_level_id = t2.grade_level_id
                    WHERE t3.grade_level_id = '$grade_level_id' ";
         if ($results=mysqli_query($connect,$query1)){
         
         $rowcount=mysqli_num_rows($results);

            for ($i=1; $i <= $rowcount; $i++) { 
                // code...
                $data = array(
                'offered_subject_id' => $_POST['offered_subject_id'.$i]
                );
                    insert_into_db($data);
            }
        mysqli_free_result($results);
        }

        //sql query for updating enrollment status
        /*$query1 = "UPDATE tbl_students SET enrollment_status = 1
                WHERE student_id='$student_id'";
        $query1_run = mysqli_query($connect, $query1);*/

        //insert grade
        $query2 = "INSERT INTO tbl_grade (enrollment_id, student_id, student_subject_id, offered_subject_id, sy_id) 
            SELECT t2.enrollment_id, t5.student_id, t1.student_subject_id, t3.offered_subject_id, t4.sy_id
            FROM tbl_student_subject AS t1
            INNER JOIN tbl_enrollment AS t2 ON t2.enrollment_id = t1.enrollment_id
            INNER JOIN tbl_offered_subject AS t3 ON t3.offered_subject_id = t1.offered_subject_id
            INNER JOIN tbl_sy AS t4 ON t4.sy_id = t2.sy_id
            INNER JOIN tbl_student AS t5 ON t5.student_id = t2.student_id
            WHERE t2.enrollment_id = $enrollment_id";
        $query2_run = mysqli_query($connect, $query2);

        //create attendance sheet
        $query_attendance = "INSERT INTO tbl_attendance (enrollment_id, student_id, sy_id, month_id)
            SELECT t1.enrollment_id, t3.student_id, t4.sy_id, t2.month_id
            FROM tbl_enrollment AS t1
            INNER JOIN tbl_month AS t2 ON t2.sy_id = t1.sy_id
            INNER JOIN tbl_student AS t3 ON t3.student_id = t1.student_id
            INNER JOIN tbl_sy AS t4 ON t4.sy_id = t1.sy_id
            WHERE t3.student_id = $student_id";
        $query_attendance_run = mysqli_query($connect, $query_attendance);

        if($query_run)
        {
            $res = [
                'status' => 200,
                'message' => 'Student Enroll Successfully'
            ];
            echo json_encode($res);
            return;
        }
        /*elseif ($query1_run) 
        {
            $res = [
                'status' => 200,
                'message' => 'Student Enroll Successfully'
            ];
            echo json_encode($res);
            return;
        }*/
        elseif ($query2_run) 
        {
            $res = [
                'status' => 200,
                'message' => 'Student Enroll Successfully'
            ];
            echo json_encode($res);
            return;
        }
        elseif ($query_attendance_run) 
        {
            $res = [
                'status' => 200,
                'message' => 'Student Enroll Successfully'
            ];
            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 500,
                'message' => 'Enrollment Failed'
            ];
            echo json_encode($res);
            return;
        }

    }

}


if(isset($_POST['update_enrollment'])) 
{
    $student_id = mysqli_real_escape_string($connect, $_POST['student_id']);
    $enrollment_id = mysqli_real_escape_string($connect, $_POST['enrollment_id']);
    $grade_level_id = mysqli_real_escape_string($connect, $_POST['grade_level_id']);
    $sy_id = mysqli_real_escape_string($connect, $_POST['sy_id']);

    if($grade_level_id == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return;
    }

    //update query
    $query = "UPDATE tbl_enrollment SET grade_level_id='$grade_level_id', sy_id='$sy_id'
            WHERE enrollment_id='$enrollment_id'";
    $query_run = mysqli_query($connect, $query);

    //delete existing subjects
    $sql_delete = "DELETE FROM tbl_student_subject
            WHERE enrollment_id='$enrollment_id'";
    $sql_delete_run = mysqli_query($connect, $sql_delete);

    //delete record on the tbl_grade
    $query_del_grade = "DELETE FROM tbl_grade
        WHERE enrollment_id='$enrollment_id'";
    $query_del_grade_run = mysqli_query($connect, $query_del_grade);

    //delete record on the tbl_student_attendance
    $query_del_attendance = "DELETE FROM tbl_attendance
        WHERE enrollment_id='$enrollment_id'";
    $query_del_attendance_run = mysqli_query($connect, $query_del_attendance);

    //insert multiple rows in tbl_student_subject
        function insert_into_db($data){
            foreach ($data as $key => $value) {
                $k[] = $key;
                $v[] = "'".$value."'";
            }
            $k=implode(",", $k);
            $v=implode(",", $v);


            $con=mysqli_connect("localhost", "ispscta6_enrollmentlhs", "!JI~*j?FKx]*", "ispscta6_db_enrollment2");
            $enrollment_id = mysqli_real_escape_string($con, $_POST['enrollment_id']);
            $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
            $sql="INSERT INTO tbl_student_subject(enrollment_id, student_id, $k) VALUES('$enrollment_id', '$student_id', $v)";
            $run_query =mysqli_query($con,$sql);                
        }

         $query1 = "SELECT t1.subject_id, t1.subject_name
                    FROM tbl_subject AS t1
                    INNER JOIN tbl_offered_subject AS t2 ON t2.subject_id = t1.subject_id
                    INNER JOIN tbl_grade_level AS t3 ON t3.grade_level_id = t2.grade_level_id
                    WHERE t3.grade_level_id = '$grade_level_id' ";
         if ($results=mysqli_query($connect,$query1)){
         
         $rowcount=mysqli_num_rows($results);

            for ($i=1; $i <= $rowcount; $i++) { 
                // code...
                $data = array(
                'offered_subject_id' => $_POST['offered_subject_id'.$i]
                );
                    insert_into_db($data);
            }
        mysqli_free_result($results);
        }

    //insert grade
    $queryGrade = "INSERT INTO tbl_grade (enrollment_id, student_id, student_subject_id, offered_subject_id, sy_id) 
            SELECT t2.enrollment_id, t5.student_id, t1.student_subject_id, t3.offered_subject_id, t4.sy_id
            FROM tbl_student_subject AS t1
            INNER JOIN tbl_enrollment AS t2 ON t2.enrollment_id = t1.enrollment_id
            INNER JOIN tbl_offered_subject AS t3 ON t3.offered_subject_id = t1.offered_subject_id
            INNER JOIN tbl_sy AS t4 ON t4.sy_id = t2.sy_id
            INNER JOIN tbl_student AS t5 ON t5.student_id = t2.student_id
            WHERE t2.enrollment_id = $enrollment_id";
    $queryGrade_run = mysqli_query($connect, $queryGrade);

    //create attendance sheet
    $query_new_attendance = "INSERT INTO tbl_attendance (enrollment_id, student_id, sy_id, month_id)
            SELECT t1.enrollment_id, t3.student_id, t4.sy_id, t2.month_id
            FROM tbl_enrollment AS t1
            INNER JOIN tbl_month AS t2 ON t2.sy_id = t1.sy_id
            INNER JOIN tbl_student AS t3 ON t3.student_id = t1.student_id
            INNER JOIN tbl_sy AS t4 ON t4.sy_id = t1.sy_id
            WHERE t3.student_id = $student_id";
    $query_new_attendance_run = mysqli_query($connect, $query_new_attendance);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Enrollment Information Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else if($sql_delete_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Enrollment Information Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else if($query_del_grade_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Enrollment Information Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else if($query_del_attendance_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Enrollment Information Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else if($queryGrade_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Enrollment Information Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else if($query_new_attendance_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Enrollment Information Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Enrollment Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['enrollment_id']))
{
    $enrollment_id = mysqli_real_escape_string($connect, $_GET['enrollment_id']);

    $query = "SELECT t1.*, CONCAT(t2.fname, ' ', LEFT(t2.mname, 1), '. ', t2.lname, ' ', t2.extension) AS 'student_name', t2.lrn, t3.*
            FROM tbl_enrollment AS t1
            INNER JOIN tbl_student AS t2 ON t2.student_id = t1.student_id
            INNER JOIN tbl_grade_level AS t3 ON t3.grade_level_id = t1.grade_level_id
            WHERE t1.enrollment_id = $enrollment_id";
    $query_run = mysqli_query($connect, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Course Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Course Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_enrollment_record']))
{
    $student_id = mysqli_real_escape_string($connect, $_POST['student_id']);

    //delete from tbl_enrollment
    $query11 = "DELETE FROM tbl_enrollment WHERE student_id='$student_id'";
    $query11_run = mysqli_query($connect, $query11);

    //change the value of enrollment_status on tbl_students
    $query22 = "UPDATE tbl_students 
        SET enrollment_status = 0 
        WHERE student_id='$student_id'";
    $query22_run = mysqli_query($connect, $query22);

    //delete record on the tbl_student_subject
    $query33 = "DELETE FROM tbl_student_subject 
        WHERE student_id='$student_id'";
    $query33_run = mysqli_query($connect, $query33);

    //delete record on the tbl_grade
    $query44 = "DELETE FROM tbl_grade
        WHERE student_id='$student_id'";
    $query44_run = mysqli_query($connect, $query44);

    //delete record on the tbl_student_attendance
    $query55 = "DELETE FROM tbl_student_attendance
        WHERE student_id='$student_id'";
    $query55_run = mysqli_query($connect, $query55);

    if($query22_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Record Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    elseif ($query11_run) {
        $res = [
            'status' => 200,
            'message' => 'Record Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    elseif ($query33_run) {
        $res = [
            'status' => 200,
            'message' => 'Record Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    elseif ($query44_run) {
        $res = [
            'status' => 200,
            'message' => 'Record Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    elseif ($query55_run) {
        $res = [
            'status' => 200,
            'message' => 'Record Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Record Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}
?>