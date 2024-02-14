<?php

include '../connect.php';

if(isset($_POST['save_grade_level']))
{   
    $faculty_id = mysqli_real_escape_string($connect, $_POST['faculty_id']);
    $grade_level = mysqli_real_escape_string($connect, $_POST['grade_level']);
    $section = mysqli_real_escape_string($connect, $_POST['section']);
    

    if($grade_level == NULL || $section == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return;
    }
    $same = mysqli_query($connect, "SELECT * FROM tbl_grade_level WHERE section = '$section' && grade_level = '$grade_level'");
    //$same_adviser = mysqli_query($connect, "SELECT * FROM tbl_faculty WHERE faculty_id = '$faculty_id'");
    if (mysqli_num_rows($same) > 0) {
 
        $res = [
            'status' => 322,
            'message' => 'Grade Level already exist'
        ];
        echo json_encode($res);
        return;

    }
    else{
        $query = "INSERT INTO tbl_grade_level (faculty_id, grade_level, section, grade_level_section) 
                  VALUES ('$faculty_id', '$grade_level', '$section', CONCAT('$grade_level', ' - ', '$section'))";
        $query_run = mysqli_query($connect, $query);

        if($query_run)
        {
            $res = [
                'status' => 200,
                'message' => 'Grade Level Created Successfully'
            ];
            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 500,
                'message' => 'Grade Level Not Created'
            ];
            echo json_encode($res);
            return;
        }
    }
}


if(isset($_POST['update_grade_level']))
{
    $grade_level_id = mysqli_real_escape_string($connect, $_POST['grade_level_id']);

    $faculty_id = mysqli_real_escape_string($connect, $_POST['faculty_id']);
    $grade_level = mysqli_real_escape_string($connect, $_POST['grade_level']);
    $section = mysqli_real_escape_string($connect, $_POST['section']);

    if($faculty_id == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE tbl_grade_level SET faculty_id='$faculty_id', grade_level='$grade_level', section='$section', grade_level_section =CONCAT('$grade_level', ' - ', '$section')
                WHERE grade_level_id='$grade_level_id'";
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
            'message' => 'Failed to Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['grade_level_id']))
{
    $grade_level_id = mysqli_real_escape_string($connect, $_GET['grade_level_id']);

    $query = "SELECT * FROM tbl_grade_level WHERE grade_level_id='$grade_level_id'";
    $query_run = mysqli_query($connect, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Grade Level Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Grade Level Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_grade_level']))
{
    $grade_level_id = mysqli_real_escape_string($connect, $_POST['grade_level_id']);

    $query = "UPDATE tbl_grade_level SET status = 0 WHERE grade_level_id ='$grade_level_id'";
    $query_run = mysqli_query($connect, $query);

    if($query_run)
    {
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
            'message' => 'Record Failed to Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

?>