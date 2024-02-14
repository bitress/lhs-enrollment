<?php

include '../connect.php';

if(isset($_POST['save_subject']))
{
    $subject_name = mysqli_real_escape_string($connect, $_POST['subject_name']);
    $subject_code = mysqli_real_escape_string($connect, $_POST['subject_code']);

    if($subject_name == NULL || $subject_code == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return;
    }
    $same = mysqli_query($connect, "SELECT * FROM tbl_subject WHERE subject_name = '$subject_name'");
    if (mysqli_num_rows($same) > 0) {

        $res = [
            'status' => 322,
            'message' => 'Subject already exist'
        ];
        echo json_encode($res);
        return;

    }else{
        $query = "INSERT INTO tbl_subject (subject_name, subject_code) VALUES ('$subject_name', '$subject_code')";
        $query_run = mysqli_query($connect, $query);

        if($query_run)
        {
            $res = [
                'status' => 200,
                'message' => 'Subject Created Successfully'
            ];
            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 500,
                'message' => 'Subject Not Created'
            ];
            echo json_encode($res);
            return;
        }
    }    
}


if(isset($_POST['update_subject']))
{
    $subject_id = mysqli_real_escape_string($connect, $_POST['subject_id']);

    $subject_name = mysqli_real_escape_string($connect, $_POST['subject_name']);
    $subject_code = mysqli_real_escape_string($connect, $_POST['subject_code']);

    if($subject_name == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE tbl_subject SET subject_name='$subject_name', subject_code='$subject_code'
            WHERE subject_id='$subject_id'";
    $query_run = mysqli_query($connect, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Subject Information Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Subject Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['subject_id']))
{
    $subject_id = mysqli_real_escape_string($connect, $_GET['subject_id']);

    $query = "SELECT * FROM tbl_subject WHERE subject_id='$subject_id'";
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

if(isset($_POST['delete_subject']))
{
    $subject_id = mysqli_real_escape_string($connect, $_POST['subject_id']);

    $query = "UPDATE tbl_subject
        SET status = 0
        WHERE subject_id='$subject_id'";
    $query_run = mysqli_query($connect, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Subject Record moved to Archive Successfully'
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
if(isset($_POST['restore_subject']))
{
    $subject_id = mysqli_real_escape_string($connect, $_POST['subject_id']);

    $query = "UPDATE tbl_subject
        SET status = 1
        WHERE subject_id='$subject_id'";
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