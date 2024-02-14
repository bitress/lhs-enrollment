<?php
include '../connect.php';


if(isset($_POST['save_fee']))
{
    $gradelevel = mysqli_real_escape_string($connect, $_POST['fee_gradelevel']);
    $sy = mysqli_real_escape_string($connect, $_POST['fee_sy']);
    $name = mysqli_real_escape_string($connect, $_POST['fee_name']);
    $collect = mysqli_real_escape_string($connect, $_POST['fee_collect']);
   

        $query = "INSERT INTO `tbl_fee` (`id`, `name`, `gradelevel`, `schoolyear`, `collect`, `datetime`) VALUES (NULL, '$name', '$gradelevel', '$sy', '$collect', current_timestamp())";

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
                'message' => 'Failed to add fee'
            ];
            echo json_encode($res);
            return;
        }
}
else if (isset($_POST['update_fee']))
{
    $feeid = mysqli_real_escape_string($connect, $_POST['edit_fee_id']);
    $feename = mysqli_real_escape_string($connect, $_POST['edit_fee_name']);
$query = "UPDATE `tbl_fee` SET `name` = '$feename' WHERE `tbl_fee`.`id` = '$feeid'";
$query_run = mysqli_query($connect, $query);

if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Fee Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
else
    {
        $res = [
            'status' => 500,
            'message' => 'Fee not updated'
        ];
        echo json_encode($res);
        return;
    }

}
else if (isset($_POST['delete_fee']))
{
    $feeid = mysqli_real_escape_string($connect, $_POST['delete_fee_id']);
$query = "UPDATE `tbl_fee` SET `status` = '1' WHERE `tbl_fee`.`id` = '$feeid'";
$query_run = mysqli_query($connect, $query);

if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Fee Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
else
    {
        $res = [
            'status' => 500,
            'message' => 'Fee not deleted'
        ];
        echo json_encode($res);
        return;
    }

}


else if(isset($_GET['edit_fee']))
{
    $fee_id = mysqli_real_escape_string($connect, $_GET['edit_fee']);

    $query = "SELECT * FROM tbl_fee WHERE id = '$fee_id'";
    
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

?>