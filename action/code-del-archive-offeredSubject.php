<?php
include '../connect.php';

//Delete Account
if(isset($_POST['del_offered_subject']))
{
    $offered_subject_id = mysqli_real_escape_string($connect, $_POST['offered_subject_id']);

    $query = "DELETE FROM `tbl_offered_subject` WHERE offered_subject_id ='$offered_subject_id'";
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