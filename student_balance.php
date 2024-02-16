<?php

include_once 'connect.php';


if (isset($_GET['id'])){

    $enrollment_id = $_GET['id'];
    $grade_level = $_GET['grade_level'];
    $sy = $_GET['sy'];

    $tuitionFeeQuery = "SELECT 
    tbl_student.lrn,
    tbl_enrollment.enrollment_id,
    tbl_student.student_id,
    tbl_student.fname,
    tbl_student.mname,
    tbl_student.lname,
    tbl_student.extension,
    t4.sy,
    tbl_grade_level.grade_level,
    GROUP_CONCAT(tbl_subject.subject_name SEPARATOR ', ') AS subjects,
    COUNT(tbl_subject.subject_id) AS num_subjects,
    SUM(tbl_offered_subject.units) AS total_units
FROM 
    tbl_student_subject 
INNER JOIN 
    tbl_offered_subject ON tbl_offered_subject.offered_subject_id = tbl_student_subject.offered_subject_id 
INNER JOIN 
    tbl_subject ON tbl_subject.subject_id = tbl_offered_subject.subject_id 
INNER JOIN 
    tbl_enrollment ON tbl_enrollment.enrollment_id = tbl_student_subject.enrollment_id 
INNER JOIN 
    tbl_student ON tbl_student.student_id = tbl_student_subject.student_id 
INNER JOIN 
    tbl_grade_level ON tbl_grade_level.grade_level_id = tbl_enrollment.grade_level_id 
INNER JOIN 
    tbl_sy AS t4 ON t4.sy_id = tbl_enrollment.sy_id 
WHERE
        tbl_enrollment.enrollment_id = '$enrollment_id'
    GROUP BY 
        tbl_student.student_id;";

    $tuitionFeeQuery_run = mysqli_query($connect, $tuitionFeeQuery);

    if ($tuitionFeeQuery_run && mysqli_num_rows($tuitionFeeQuery_run) > 0) {
        $r = mysqli_fetch_assoc($tuitionFeeQuery_run);
        $tuitionFeePayment = $r['total_units'] * 150;
    }




    // ============COLLECTION PAYMENT====================//

    $collectionSql = "SELECT SUM(a.collect) as collection FROM tbl_fee as a 
                                                        WHERE a.gradelevel = '$grade_level' 
                                                        AND a.schoolyear = '$sy'";
    $result2 = mysqli_query($connect, $collectionSql);
    $collection = mysqli_fetch_assoc($result2)['collection'];
    $collection = $collection>1 ? $collection : 0;
    // ============PAYMENTS====================//
    $paymentSql = "SELECT *,SUM(payment) as totalpayment FROM `tbl_payments` WHERE `enrollment_id` = '$enrollment_id'";
    $result3 = mysqli_query($connect, $paymentSql);
    $payment = mysqli_fetch_assoc($result3)['totalpayment'];
//                                                        $payment = $payment > 1 ? $payment : 0;


    $totalCollection = $tuitionFeePayment + $collection;

    $totalbal = ($totalCollection) - $payment;

    if ($payment == 0) {
        $status = '<span class="badge badge-warning">Not Paid</span>';
    } else if ($payment >= $totalCollection) {
        $status = '<span class="badge badge-success">Paid</span>';
    } else if ($payment >0) {
        $status = '<span class="badge badge-info">Pending</span>';
    } else {
        $status = "idk";
    }

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>



    <div class="container mt-4">
        <div class="row">
            <div class="col-4">
                <h3>Student Name</h3>
                <p><?= $grade_level ?> <br>
                    School Year: <?= $sy ?><br>
                </p>
                <p class="text-muted">Balance: <?= number_format($totalbal, 2) ?></p>
            </div>
            <div class="col-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">OR Number</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    $payment_sql = "SELECT or_number, payment, datetime FROM tbl_payments WHERE enrollment_id = $enrollment_id";
                    $payment_result = mysqli_query($connect, $payment_sql);
                    while ($payment_row = mysqli_fetch_array($payment_result)) {

                    ?>
                    <tr>
                        <th scope="row"><?= $payment_row['or_number'] ?></th>
                        <td><?= $payment_row['payment'] ?></td>
                        <td><?=  $payment_row['datetime'] ?></td>
                    </tr>

                    <?php
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>