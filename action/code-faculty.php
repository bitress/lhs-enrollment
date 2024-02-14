<?php

include '../connect.php';

//Save
if(isset($_POST['save_faculty']))
{   
    $honorifics = $_POST['honorifics'];
    $fname = mysqli_real_escape_string($connect, $_POST['fname']);
    $mname = mysqli_real_escape_string($connect, $_POST['mname']);
    $lname = mysqli_real_escape_string($connect, $_POST['lname']);
    $title = mysqli_real_escape_string($connect, $_POST['title']);
    $gender = $_POST['gender']; 
    $birthdate = date('Y-m-d', strtotime($_POST['birthdate']));
    $position = mysqli_real_escape_string($connect, $_POST['position']);
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $userType = $_POST['userType'];
    //$hash_password = password_hash($password, PASSWORD_DEFAULT);

    $fname = stripcslashes($fname);
    $mname = stripcslashes($mname);
    $lname = stripcslashes($lname);
    //$address = stripcslashes($address);
    $username = stripcslashes($username);
    $email = stripcslashes($email);
    $password = stripcslashes($password);

    if($fname == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return;
    }
    $same = mysqli_query($connect, "SELECT * FROM tbl_faculty WHERE username = '$username'");
    if (mysqli_num_rows($same) > 0) {

        $res = [
            'status' => 322,
            'message' => 'This user is already registered'
        ];
        echo json_encode($res);
        return;

    }else{
        $query = "INSERT INTO `tbl_faculty`(`honorifics`, `fname`, `mname`, `lname`, `gender`, `title`, `position`, `birthdate`, `email`, `username`, `password`, `userType`) 
                  VALUES ('$honorifics', '$fname','$mname','$lname','$gender','$title','$position','$birthdate','$email','$username','$password','$userType')";
        $query_run = mysqli_query($connect, $query);

        if($query_run)
        {
            $res = [
                'status' => 200,
                'message' => 'Faculty Record Created Successfully'
            ];
            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 500,
                'message' => 'Faculty Not Created'
            ];
            echo json_encode($res);
            return;
        }
    }
}

//Get information
if(isset($_GET['faculty_id']))
{
    $faculty_id = mysqli_real_escape_string($connect, $_GET['faculty_id']);

    $query = "SELECT * FROM tbl_faculty WHERE faculty_id='$faculty_id'";
    $query_run = mysqli_query($connect, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Faculty Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Faculty Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

//Save Update Account
if(isset($_POST['update_faculty']))
{
    $faculty_id = mysqli_real_escape_string($connect, $_POST['faculty_id']);

    $title = $_POST['title'];
    $fname = mysqli_real_escape_string($connect, $_POST['fname']);
    $mname = mysqli_real_escape_string($connect, $_POST['mname']);
    $lname = mysqli_real_escape_string($connect, $_POST['lname']);
    $honorifics = mysqli_real_escape_string($connect, $_POST['honorifics']);
    $gender = $_POST['gender'];
    $birthdate = date('Y-m-d', strtotime($_POST['birthdate']));
    $position = $_POST['position'];
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $userType = $_POST['userType'];
    //$hash_password = password_hash($password, PASSWORD_DEFAULT);

    $fname = stripcslashes($fname);
    $mname = stripcslashes($mname);
    $lname = stripcslashes($lname);
    //$address = stripcslashes($address);
    $username = stripcslashes($username);
    $email = stripcslashes($email);
    $password = stripcslashes($password);

    if($fname == NULL || $mname == NULL || $lname == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE tbl_faculty SET honorifics='$honorifics', fname='$fname', mname='$mname', lname='$lname', title='$title', gender='$gender', birthdate='$birthdate', position='$position', username='$username', email='$email', password='$password', userType='$userType' 
                WHERE faculty_id='$faculty_id'";
    $query_run = mysqli_query($connect, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Faculty Information Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Faculty Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}

//Delete Account
if(isset($_POST['delete_faculty']))
{
    $faculty_id = mysqli_real_escape_string($connect, $_POST['faculty_id']);

    $query = "UPDATE tbl_faculty SET status = 0 WHERE faculty_id ='$faculty_id'";
    $query_run = mysqli_query($connect, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Faculty Record moved to Archive Successfully'
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
if(isset($_POST['restore_faculty']))
{
    $faculty_id = mysqli_real_escape_string($connect, $_POST['faculty_id']);

    $query = "UPDATE tbl_faculty SET status = 1 WHERE faculty_id ='$faculty_id'";
    $query_run = mysqli_query($connect, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Faculty Record Restored Successfully'
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