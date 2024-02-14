<?php

include '../connect.php';

if(isset($_POST['save_student']))
{
    $lrn = mysqli_real_escape_string($connect, $_POST['lrn']);
    $fname = mysqli_real_escape_string($connect, $_POST['fname']);
    $mname = mysqli_real_escape_string($connect, $_POST['mname']);
    $lname = mysqli_real_escape_string($connect, $_POST['lname']);
    $extension = mysqli_real_escape_string($connect, $_POST['extension']);
    $gender = $_POST['gender'];
    $birthdate = date('Y-m-d', strtotime($_POST['birthdate']));
    $address = mysqli_real_escape_string($connect, $_POST['address']);
    $prevschool = mysqli_real_escape_string($connect, $_POST['prevschool']);
    $pbirth = mysqli_real_escape_string($connect, $_POST['pbirth']);
    $cnumber = mysqli_real_escape_string($connect, $_POST['cnumber']);
    $schoolYear = mysqli_real_escape_string($connect, $_POST['schoolYear']);
    $f_fname = mysqli_real_escape_string($connect, $_POST['f_fname']);
    $f_mname = mysqli_real_escape_string($connect, $_POST['f_mname']);
    $f_lname = mysqli_real_escape_string($connect, $_POST['f_lname']);
    $f_extension = mysqli_real_escape_string($connect, $_POST['f_extension']);
    $f_occupation = mysqli_real_escape_string($connect, $_POST['f_occupation']);
    $m_fname = mysqli_real_escape_string($connect, $_POST['m_fname']);
    $m_mname = mysqli_real_escape_string($connect, $_POST['m_mname']);
    $m_lname = mysqli_real_escape_string($connect, $_POST['m_lname']);
    $m_extension = mysqli_real_escape_string($connect, $_POST['m_extension']);
    $m_occupation = mysqli_real_escape_string($connect, $_POST['m_occupation']);

    if($fname == NULL || $mname == NULL || $lname == NULL || $gender == NULL || $birthdate == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return;
    }
    $same = mysqli_query($connect, "SELECT * FROM tbl_student WHERE fname = '$fname' AND mname = '$mname' AND lname = '$lname'");
    if (mysqli_num_rows($same) > 0) {

        $res = [
            'status' => 322,
            'message' => 'Student already exist'
        ];
        echo json_encode($res);
        return;

    }else{
        $query = "INSERT INTO tbl_student (lrn, fname, mname, lname, extension, gender, birthdate, prevschool, address, pbirth, cnumber, schoolYear, f_fname, f_mname, f_lname, f_extension, f_occupation, m_fname, m_mname, m_lname, m_extension, m_occupation) 
                  VALUES ('$lrn', '$fname','$mname','$lname','$extension','$gender','$birthdate','$prevschool','$address','$pbirth','$cnumber','$schoolYear','$f_fname','$f_mname','$f_lname','$f_extension','$f_occupation','$m_fname','$m_mname','$m_lname','$m_extension','$m_occupation')";
        $query_run = mysqli_query($connect, $query);

        if($query_run)
        {
            $res = [
                'status' => 200,
                'message' => 'Student Record Created Successfully'
            ];
            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 500,
                'message' => 'Student Not Created'
            ];
            echo json_encode($res);
            return;
        }
    }    
}


if(isset($_POST['update_student']))
{
    $student_id = mysqli_real_escape_string($connect, $_POST['student_id']);

    $lrn = mysqli_real_escape_string($connect, $_POST['lrn']);
    $fname = mysqli_real_escape_string($connect, $_POST['fname']);
    $mname = mysqli_real_escape_string($connect, $_POST['mname']);
    $lname = mysqli_real_escape_string($connect, $_POST['lname']);
    $extension = mysqli_real_escape_string($connect, $_POST['extension']);
    $gender = $_POST['gender'];
    $birthdate = date('Y-m-d', strtotime($_POST['birthdate']));

    if($fname == NULL || $mname == NULL || $lname == NULL || $gender == NULL || $birthdate == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE tbl_student SET lrn='$lrn', fname='$fname', mname='$mname', lname='$lname', extension='$extension', gender='$gender', birthdate='$birthdate'
            WHERE student_id='$student_id'";
    $query_run = mysqli_query($connect, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Student Information Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Student Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['student_id']))
{
    $student_id = mysqli_real_escape_string($connect, $_GET['student_id']);

    $query = "SELECT * FROM tbl_student WHERE student_id='$student_id'";
    $query_run = mysqli_query($connect, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Student Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Student Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_student']))
{
    $student_id = mysqli_real_escape_string($connect, $_POST['student_id']);

    $query = "UPDATE tbl_student
        SET status = 0
        WHERE student_id='$student_id'";
    $query_run = mysqli_query($connect, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Student Record moved to Archive Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Action Failed'
        ];
        echo json_encode($res);
        return;
    }
}

//restore
if(isset($_POST['restore_student']))
{
    $student_id = mysqli_real_escape_string($connect, $_POST['student_id']);

    $query = "UPDATE tbl_student
        SET status = 1
        WHERE student_id='$student_id'";
    $query_run = mysqli_query($connect, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Student Record Restored Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Action Failed'
        ];
        echo json_encode($res);
        return;
    }
}

?>