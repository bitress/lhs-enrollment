<?php

include '../connect.php';

if(isset($_POST['save_offered_subject']))
{
    $faculty_id = mysqli_real_escape_string($connect, $_POST['faculty_id']);
    $subject_id = mysqli_real_escape_string($connect, $_POST['subject_id']);
    $grade_level_id = mysqli_real_escape_string($connect, $_POST['grade_level_id']);
    $sy_id = mysqli_real_escape_string($connect, $_POST['sy_id']);
    $hrsSem = mysqli_real_escape_string($connect, $_POST['hrsSem']);
    $hrsWeek = mysqli_real_escape_string($connect, $_POST['hrsWeek']);
    $units = mysqli_real_escape_string($connect, $_POST['units']);
 
    if($faculty_id == NULL || $subject_id == NULL || $grade_level_id == NULL || $sy_id == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return;
    }
    //$same = mysqli_query($connect, "SELECT * FROM tbl_offered_subject WHERE subject_id = '$subject_id' AND course_id = '$course_id' ");

    /*if (mysqli_num_rows($same) > 0) {

        $res = [
            'status' => 322,
            'message' => 'Subject already assigned'
        ];
        echo json_encode($res);
        return;

    }else{*/
        $query = "INSERT INTO tbl_offered_subject (faculty_id, subject_id, grade_level_id, sy_id, hrsSem, hrsWeek, units) 
                  VALUES ('$faculty_id', '$subject_id', '$grade_level_id', '$sy_id', '$hrsSem', '$hrsWeek', '$units')";
        $query_run = mysqli_query($connect, $query);

        if($query_run)
        {
            $res = [
                'status' => 200,
                'message' => 'Created Successfully'
            ];
            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 500,
                'message' => 'Failed to assign subjects'
            ];
            echo json_encode($res);
            return;
        }
    //}    
}


if(isset($_POST['update_offered_subject']))
{
    $offered_subject_id = mysqli_real_escape_string($connect, $_POST['offered_subject_id']);

    $faculty_id = mysqli_real_escape_string($connect, $_POST['faculty_id']);
    //$subject_id = mysqli_real_escape_string($connect, $_POST['subject_id']);
    $grade_level_id = mysqli_real_escape_string($connect, $_POST['grade_level_id']);
    $sy_id = mysqli_real_escape_string($connect, $_POST['sy_id']);
    $hrsSem = mysqli_real_escape_string($connect, $_POST['hrsSem']);
    $hrsWeek = mysqli_real_escape_string($connect, $_POST['hrsWeek']);
    $units = mysqli_real_escape_string($connect, $_POST['units']);

    if($faculty_id == NULL || $grade_level_id == NULL || $sy_id == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE tbl_offered_subject SET faculty_id='$faculty_id', grade_level_id='$grade_level_id', sy_id='$sy_id', hrsSem='$hrsSem', hrsWeek='$hrsWeek', units = '$units'
                WHERE offered_subject_id='$offered_subject_id'";
    $query_run = mysqli_query($connect, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Information Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Failed to update'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['offered_subject_id']))
{
    $offered_subject_id = mysqli_real_escape_string($connect, $_GET['offered_subject_id']);

    $query = "SELECT * FROM tbl_offered_subject WHERE offered_subject_id='$offered_subject_id'";
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
            'message' => 'Record Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_offered_subject']))
{
    $offered_subject_id = mysqli_real_escape_string($connect, $_POST['offered_subject_id']);

    $query = "UPDATE `tbl_offered_subject` SET `status`= 0 WHERE offered_subject_id='$offered_subject_id'";
    $query_run = mysqli_query($connect, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Record moved to Archive Successfully'
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
if(isset($_POST['restore_offered_subject']))
{
    $offered_subject_id = mysqli_real_escape_string($connect, $_POST['offered_subject_id']);

    $query = "UPDATE tbl_offered_subject
        SET status = 1
        WHERE offered_subject_id='$offered_subject_id'";
    $query_run = mysqli_query($connect, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Record Restored Successfully'
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