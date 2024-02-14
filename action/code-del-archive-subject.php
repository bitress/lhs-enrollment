<?php
include '../connect.php';

//Delete Account
if(isset($_POST['del_subject']))
{
    $subject_id = mysqli_real_escape_string($connect, $_POST['subject_id']);

    $query = "DELETE FROM `tbl_subject` WHERE subject_id ='$subject_id'";
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
?>