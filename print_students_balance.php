<?php
include 'connect.php';

  if (isset($_GET['grade_level'])) {
        $gradelevel = $_GET['grade_level'];
        $type = $_GET['type'];
    } else {
        header("Location: cashier_reports.php");
    }
  ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            table-layout: fixed;
        }

        table caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
        }

        table tr {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            padding: .35em;
        }

        table th,
        table td {
            padding: .625em;
            text-align: center;
        }

        table th {
            font-size: .85em;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }

            table td::before {
                /*
                * aria-label has no advantage, it won't be read inside a table
                content: attr(aria-label);
                */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                border-bottom: 0;
            }
        }

        /* general styling */
        body {


            font-family: "Open Sans", sans-serif;
            line-height: 1.25;
        }

        @media print {
            .print-button {
                display: none;
            }
        }

        .print-button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        .header-container {
            text-align: center;
            padding: 20px;
            border-bottom: 1px solid #ccc;
        }
        header {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo {
            width: 70px;
            height: auto;
        }
        .column {
            margin-left: 20px; /* Adjust spacing between logo and text */
            text-align: left;
        }
        h3, h4 {
            margin: 5px 0;
            color: #333;
        }




    </style>
</head>
<body>

<div class="header-container">
<header>
    <img src="https://dev.bitress.xyz/ispsc-tagudin-website/assets/img/ispsc_logo.png" alt="Logo" class="logo">
    <div class="column">
        <h3>Ilocos Sur Polytechnic State College</h3>
        <h4>Laboratory High School</h4>
    </div>
</header>
</div>
<?php

if ($type === 'student_balance'){

?>
<table>
    <caption>Student Balance <br> <?= $_GET['grade_level'] ?>  </caption>
    <thead>
    <tr>
        <th scope="col">LRN</th>
        <th scope="col">Student Name</th>
        <th scope="col">Grade Level & Section</th>
        <th scope="col">School Year</th>
        <th scope="col">Amount</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sql = "SELECT t1.*, t2.*, t3.*, t4.*
                                                            FROM tbl_enrollment AS t1
                                                            INNER JOIN tbl_student AS t2 ON t2.student_id = t1.student_id
                                                            INNER JOIN tbl_grade_level AS t3 ON t3.grade_level_id = t1.grade_level_id
                                                            INNER JOIN tbl_sy AS t4 ON t4.sy_id = t1.sy_id
                                                            WHERE t1.status = 1 AND t3.grade_level = '$gradelevel'";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $middle_name = substr($row["mname"], 0, 1);
        $grade_level = $row['grade_level'];
        $sy = $row['sy'];
        $enrollment_id = $row['enrollment_id'];
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
        $collection = mysqli_fetch_assoc($result2) ['collection'];
        $collection = $collection > 1 ? $collection : 0;
        // ============PAYMENTS====================//
        $paymentSql = "SELECT *,SUM(payment) as totalpayment FROM `tbl_payments` WHERE `enrollment_id` = '$enrollment_id'";
        $result3 = mysqli_query($connect, $paymentSql);
        $payment = mysqli_fetch_assoc($result3) ['totalpayment'];
        //                                                        $payment = $payment > 1 ? $payment : 0;
        $totalCollection = $tuitionFeePayment + $collection;
        $totalbal = ($totalCollection) - $payment;
        if ($payment == 0) {
            $status = '<span class="badge badge-warning">Not Paid</span>';
        } else if ($payment >= $totalCollection) {
            $status = '<span class="badge badge-success">Paid</span>';
        } else if ($payment > 0) {
            $status = '<span class="badge badge-info">Pending</span>';
        } else {
            $status = "idk";
        }
        //
        //

        ?>
        <tr>
            <td data-label="Student Name">
                <?php echo $row["lrn"] ?>
            </td>  <td data-label="Student Name">
                <?php echo $row["fname"] ?> <?php echo $middle_name?>. <?php echo $row["lname"] ?> <?php echo $row["extension"] ?>
            </td>
            <td data-label="Grade Level & Section">
                <?php echo $row["grade_level_section"] ?>
            </td><td data-label="Grade Level & Section">
                <?php echo $row["sy"] ?>
            </td>
            <td data-label="Amount">
                P<?php echo number_format($totalbal, 2) ?>
            </td>
        </tr>

        <?php
    }
    ?>
    </tbody>

</table>


<?php

} else {
    if(isset($_GET['day_range']) && !empty($_GET['day_range'])) {
        $day_range = $_GET['day_range'];

        $dates = explode(" - ", $day_range);
        $start_date = date('Y-m-d H:i:s', strtotime($dates[0])); // Convert start date to Y-m-d format with current time
        $end_date = date('Y-m-d H:i:s', strtotime($dates[1])); // Convert end date to Y-m-d format with current time

    }

?>




<table>
    <caption>Collection <br> <?= $_GET['grade_level'] ?>  </caption>
    <thead>
    <tr>
        <th scope="col">LRN</th>
        <th scope="col">Student Name</th>
        <th scope="col">Grade Level</th>
        <th scope="col">Fee Name</th>
        <th scope="col">Amount</th>
        <th scope="col">Date Time</th>
    </tr>
    </thead>
    <tbody>

    <?php
    $sql = "SELECT t1.*, t2.*, t3.*, t5.* FROM tbl_enrollment AS t1 INNER JOIN tbl_student AS t2 ON t2.student_id = t1.student_id INNER JOIN tbl_grade_level AS t3 ON t3.grade_level_id = t1.grade_level_id INNER JOIN tbl_payments AS t5 ON t5.enrollment_id = t1.enrollment_id WHERE DATE(t5.datetime)  BETWEEN '$start_date' AND '$end_date' AND t3.grade_level = '$gradelevel';";
    $conn = mysqli_query($connect, $sql);

    while ($r = mysqli_fetch_assoc($conn)){

        ?>

        <tr>
            <td><?= $r['lrn'] ?></td>
            <td>            <?php echo $r["fname"] ?> <?php echo $r["lname"] ?> <?php echo $r["extension"] ?>
            </td>
            <td><?= $r['grade_level'] ?></td>
            <td><?= $r['fee_name'] ?></td>
            <td><?= $r['payment'] ?></td>
            <td><?= $r['datetime'] ?></td>
        </tr>

        <?php
    }
    ?>

    </tbody>
</table>


<?php
}
?>

<br>
<div style="display: flex; justify-content: center">
    <button class="print-button" onclick="window.print()">Print</button>

</div>




</body>
</html>