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
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="grade_level">Grade Level</label>
                                        <select id="grade_level" class="form-control">
                                            <option selected disabled>Select Grade Level</option>
                                            <option value="Grade 7">Grade 7</option>
                                            <option value="Grade 8">Grade 8</option>
                                            <option value="Grade 9">Grade 9</option>
                                            <option value="Grade 10">Grade 10</option>
                                            <option value="Grade 11">Grade 11</option>
                                            <option value="Grade 12">Grade 12</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="report_type">What do you want to report?</label>
                                        <select id="report_type" class="form-control">
                                            <option selected disabled>What do you want to report?</option>
                                            <option value="collection_per_day">Collection Per Day</option>
                                            <option value="student_balance">Student Balance</option>
                                        </select>
                                    </div>

                                    <div class="mb-3" id="day_range_container" style="display: none;">
                                        <label for="day_range">Select Day Range</label>
                                        <input type="text" name="day_range" class="form-control" id="day_range">
                                    </div>
                                    <div class="mb-3">
                                        <a class="btn btn-success" id="print_link" href="#" type="button">Print</a>
                                    </div>
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- DataTable -->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myTable').DataTable();
    });
    let date = new Date().toLocaleDateString();

    $('input[name="day_range"]').daterangepicker({
        "maxDate": date
    });

</script>

<script>
    document.getElementById('report_type').addEventListener('change', function () {
        var dayRangeContainer = document.getElementById('day_range_container');
        if (this.value === 'collection_per_day') {
            dayRangeContainer.style.display = 'block';
        } else {
            dayRangeContainer.style.display = 'none';
        }
    });


    document.getElementById('print_link').addEventListener('click', function() {
        var gradeLevel = document.getElementById('grade_level').value;
        var reportType = document.getElementById('report_type').value;
        var day_range = document.getElementById('day_range').value;
        var url = 'print_students_balance.php?grade_level=' + encodeURIComponent(gradeLevel) + '&type=' + encodeURIComponent(reportType) + '&day_range='+ encodeURIComponent(day_range);
        window.location.href = url;
    });
</script>


<!-- Bottom Section-->
<?php include 'include/botSection.php'; ?>