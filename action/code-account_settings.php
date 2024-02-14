<?php

include '../connect.php';

if(isset($_POST['save_img']))
{
    $faculty_id = mysqli_real_escape_string($connect, $_POST['faculty_id']);
    $image=$_FILES['image']['name'];

    if($image == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE tbl_faculty SET image='$image'
            WHERE faculty_id='$faculty_id'";
    $query_run = mysqli_query($connect, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'School Year Information Updated Successfully'
        ];
        echo json_encode($res);
        move_uploaded_file($_FILES['image']['tmp_name'], "../profile_image/$image");
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


if(isset($_GET['faculty_id']))
{
    $faculty_id = mysqli_real_escape_string($connect, $_GET['faculty_id']);

    $query = "SELECT * FROM `tbl_faculty` WHERE faculty_id='$faculty_id'";
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
    //$password = mysqli_real_escape_string($connect, $_POST['password']);
    //$userType = $_POST['userType'];
    //$hash_password = password_hash($password, PASSWORD_DEFAULT);

    $fname = stripcslashes($fname);
    $mname = stripcslashes($mname);
    $lname = stripcslashes($lname);
    //$address = stripcslashes($address);
    $username = stripcslashes($username);
    $email = stripcslashes($email);
    //$password = stripcslashes($password);

    if($fname == NULL || $mname == NULL || $lname == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE tbl_faculty SET honorifics='$honorifics', fname='$fname', mname='$mname', lname='$lname', title='$title', gender='$gender', birthdate='$birthdate', position='$position', username='$username', email='$email' 
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

//change password
if(isset($_POST['updatePassword']))
{
    $faculty_id = mysqli_real_escape_string($connect, $_POST['faculty_id']);

    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $npassword = mysqli_real_escape_string($connect, $_POST['npassword']);
    $cnpassword = mysqli_real_escape_string($connect, $_POST['cnpassword']);
    //$hashedpass=password_hash($password, PASSWORD_DEFAULT);
    //$newhashedpass=password_hash($npassword, PASSWORD_DEFAULT);

    $password = stripcslashes($password);
    $npassword = stripcslashes($npassword);
    $cnpassword = stripcslashes($cnpassword);

    //collect password from database
    $sql=mysqli_query($connect,"SELECT password FROM tbl_faculty WHERE faculty_id='$faculty_id'");
    $row=mysqli_fetch_array($sql);

    if($npassword == NULL || $cnpassword == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return;
    }
    if($row>0){
        $dbpassword=$row['password'];
            if($npassword != $cnpassword){
                if($password != "SELECT password FROM tbl_faculty WHERE faculty_id='$faculty_id'"){
                    $res = [
                        'status' => 630,
                        'message' => 'Old Password does not match in our database'
                    ];
                    echo json_encode($res);
                    return; 
                }
                else{
                    $res = [
                        'status' => 730,
                        'message' => 'Password did not match'
                    ];
                    echo json_encode($res);
                    return; 
                }
            }
            else{
                if ($password = $dbpassword) {
                    $query = "UPDATE tbl_faculty SET password='$npassword'
                    WHERE faculty_id='$faculty_id'";
                    $query_run = mysqli_query($connect, $query);

                    $res = [
                        'status' => 230,
                        'message' => 'Password Updated Successfully'
                    ];
                    echo json_encode($res);
                    return;
                }
                else{
                    $res = [
                        'status' => 530,
                        'message' => 'Password Failed to Update'
                    ];
                    echo json_encode($res);
                    return;
                }
            }
                
    }
    
}

?>