<?php

session_start();
include 'connect.php';

if (isset($_SESSION['username'])) {
}
else{

    header("location: login.php");

}

include 'include/topSection.php';

?>

    <body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include 'include/sidebar.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include 'include/topbar.php'; ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">REPORTS</h1>
                </div>

                <!-- Content -->


                <div class="container mt-4 mb-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex mb-2">
                                <a href="cashier_reports_print.php" target="_blank" class="btn btn-success"><i class="fal fa-print"></i>&nbsp;Print</a>
                            </div>
                            <div class="card shadow">
                                <div class="card-header">
                                    <h4><i class="fas fa-list"></i> Collection per day
                                    </h4>
                                </div>
                                <div class="card-body table-responsive">
                                    <table id="myTable" class="table table-bordered table-hover">
                                        <thead class="table-primary">
                                        <tr>
                                            <th class="text-center"> Date </th>
                                            <th class="text-center"> Amount Collected </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        include 'connect.php';
                                        $sql = "SELECT
                                    DATE(datetime) AS payment_date,
                                    SUM(payment) AS total_collection
                                FROM
                                    tbl_payments
                                GROUP BY
                                    DATE(datetime)
                                ORDER BY
                                    payment_date DESC;
                                ";
                                $result = mysqli_query($connect, $sql);

                                        while ($row = mysqli_fetch_array($result)) {

                                            ?>

                                            <tr>
                                                <td class="text-center">
                                                    <?php echo $row['payment_date'] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row['total_collection'] ?>
                                                </td>

                                            </tr>

                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include 'include/footer.php'; ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Profile Settings Modal-->
<?php include 'include/profile_settings.php'; ?>

<!-- Logout Modal-->
<?php include 'include/logout.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<!-- Alertify -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Include SweetAlert 2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>

<!-- DataTable -->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myTable').DataTable();
    });
</script>




<!-- Bottom Section-->
<?php include 'include/botSection.php'; ?>