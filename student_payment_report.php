<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

    <!-- Invoice styling -->
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
            margin-top: 20px;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
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


<div class="invoice-box">
    <table>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            <?= $_GET['name'] ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>



        <tr class="heading">
            <td>OR Number</td>
            <td>Amount</td>
            <td>Fee Name</td>
            <td>Date</td>
        </tr>

        <?php

        $enrollment_id = $_GET['id'];

        include 'connect.php';
        $payment_sql = "SELECT or_number, payment, fee_name, datetime FROM tbl_payments WHERE enrollment_id = $enrollment_id";
        $payment_result = mysqli_query($connect, $payment_sql);
        $total = 0;
        while ($payment_row = mysqli_fetch_array($payment_result)):

            $total += $payment_row['payment'];
        ?>

        <tr class="item">
            <td><?= $payment_row['or_number'] ?></td>
            <td><?= $payment_row['payment'] ?></td>
            <td><?= $payment_row['fee_name'] ?></td>
            <td><?= $payment_row['datetime'] ?></td>
        </tr>
            <?php endwhile; ?>



        <tr class="total">
            <td></td>
            <td>Total: <?php echo number_format($total, 2); ?></td>

        </tr>
    </table>
</div>
</body>
</html>
