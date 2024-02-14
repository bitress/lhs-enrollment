<?php

include '../connect.php';

if(isset($_POST['save_sy']))
{
    $sy = mysqli_real_escape_string($connect, $_POST['sy']);

    if($sy == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return;
    }
    $same = mysqli_query($connect, "SELECT * FROM tbl_sy WHERE sy = '$sy'");
    if (mysqli_num_rows($same) > 0) {

        $res = [
            'status' => 322,
            'message' => 'School Year already exist'
        ];
        echo json_encode($res);
        return;

    }else{
        $query = "INSERT INTO tbl_sy (sy) VALUES ('$sy')";
        $query_run = mysqli_query($connect, $query);

        if($query_run)
        {
            $res = [
                'status' => 200,
                'message' => 'School Year Created Successfully'
            ];
            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 500,
                'message' => 'School Year Failed to Created'
            ];
            echo json_encode($res);
            return;
        }
    }    
}


if(isset($_POST['update_sy']))
{
    $sy_id = mysqli_real_escape_string($connect, $_POST['sy_id']);

    $sy = mysqli_real_escape_string($connect, $_POST['sy']);

    if($sy == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE tbl_sy SET sy='$sy'
            WHERE sy_id='$sy_id'";
    $query_run = mysqli_query($connect, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'School Year Information Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'School Year Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['sy_id']))
{
    $sy_id = mysqli_real_escape_string($connect, $_GET['sy_id']);

    $query = "SELECT * FROM tbl_sy WHERE sy_id='$sy_id'";
    $query_run = mysqli_query($connect, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'School Year Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'School Year Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_subject']))
{
    $sy_id = mysqli_real_escape_string($connect, $_POST['sy_id']);

    $query = "UPDATE tbl_subject
        SET status = 0
        WHERE sy_id='$sy_id'";
    $query_run = mysqli_query($connect, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Student Record Deleted Successfully'
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