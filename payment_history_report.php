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



    </style>
</head>
<body>
<table>
    <caption>Payment History Summary</caption>
    <thead>
    <tr>
        <th scope="col">OR Number</th>
        <th scope="col">LRN</th>
        <th scope="col">Student Name</th>
        <th scope="col">Grade Level & Section</th>
        <th scope="col">School Year</th>
        <th scope="col">Amount</th>
        <th scope="col">Timestamp</th>

    </tr>
    </thead>
    <tbody>
                <?php
                include 'connect.php';
                $sql = "SELECT a.*,
                    b.name,
                    CONCAT(d.fname,' ',d.mname,' ',d.lname,' ',d.extension) as fullname,d.lrn,
                    e.grade_level_section,b.name as feename
                    FROM `tbl_payments` as a 
                    LEFT JOIN tbl_fee as b 
                    ON a.fee_id = b.id
                    LEFT JOIN tbl_enrollment as c 
                    ON a.enrollment_id = c.enrollment_id
                    LEFT JOIN tbl_student as d 
                    ON c.student_id = d.student_id
                    LEFT JOIN tbl_grade_level as e 
                    ON c.grade_level_id = e.grade_level_id";
                $result = mysqli_query($connect, $sql);
                $total = 0;
                while ($row = mysqli_fetch_array($result)):
                    $total += $row['payment'];
                ?>
    <tr>
        <td data-label="OR Number">
            <?php echo $row["or_number"] ?>
        </td>
        <td data-label="Student Name">
            <?php echo $row["lrn"] ?>
        </td>  <td data-label="Student Name">
            <?php echo $row["fullname"] ?>
        </td>
        <td data-label="Grade Level & Section">
            <?php echo $row["grade_level_section"] ?>
        </td><td data-label="Grade Level & Section">
            <?php echo $row["schoolyear"] ?>
        </td>
        <td data-label="Amount">
            P<?php echo number_format($row['payment'],2) ?>
        </td>
        <td data-label="Timestamp">
            <?php echo $row['datetime'] ?>
        </td>
    </tr>

                <?php
                endwhile;
                ?>
    </tbody>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Total: P<?php echo number_format($total, 2); ?></td>
        <td></td>
    </tr>
</table>

<br>
<div style="display: flex; justify-content: center">
    <button class="print-button" onclick="window.print()">Print</button>

</div>




</body>
</html>