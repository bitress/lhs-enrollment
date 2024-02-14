<?php   
  
    session_start();
    include 'connect.php';

    if (isset($_SESSION['username'])) {
    }
    else{

      header("location: ../login.php");
      
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
                        <h1 class="h3 mb-0 text-gray-800">MANAGE STUDENT ATTENDANCE</h1>
                    </div>

                    <!-- Content -->

                    <?php include 'include/form/form_student.php'; ?>

                    <div class="container mt-4 mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <h4 class="text-uppercase">
                                            <?php
                                                if(isset($_SESSION['faculty_id'])){
                                                  $faculty_id=$_SESSION['faculty_id'];

                                                  include 'connect.php';
                                                  $query = "SELECT t1.*, t2.*
                                                            FROM tbl_grade_level AS t1
                                                            INNER JOIN tbl_faculty AS t2 ON t2.faculty_id = t1.faculty_id
                                                            WHERE t1.faculty_id = $faculty_id";
                                                  $result = mysqli_query($connect, $query);
                                                  while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                                <i class="fas fa-users"></i> List of <?php echo $row['grade_level_section']; ?> Students
                                            <?php 
                                                    }
                                                }  
                                            ?>
                                        </h4>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="myTable" class="table table-bordered table-hover">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th class="text-center"> Name </th>
                                                    <th class="text-center"> Grade Level & Section </th>
                                                    <th class="text-center"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if(isset($_SESSION['faculty_id'])){
                                                        $faculty_id=$_SESSION['faculty_id'];

                                                        include 'connect.php';
                                                        $sql = "SELECT t1.enrollment_id, t2.student_id, t2.fname, t2.mname, t2.lname, t2.lrn, t2.extension, t2.gender, CURDATE(), TIMESTAMPDIFF(YEAR, t2.birthdate, CURDATE()) AS 'age', t3.grade_level_section, t4.faculty_id, CONCAT(t4.honorifics, ' ', t4.lname) AS 'adviser', t5.*
                                                            FROM tbl_enrollment AS t1
                                                            INNER JOIN tbl_student AS t2 ON t2.student_id = t1.student_id
                                                            INNER JOIN tbl_grade_level AS t3 ON t3.grade_level_id = t1.grade_level_id
                                                            INNER JOIN tbl_faculty AS t4 ON t4.faculty_id = t3.faculty_id
                                                            INNER JOIN tbl_sy AS t5 ON t5.sy_id = t1.sy_id
                                                            WHERE t3.faculty_id = $faculty_id
                                                            ORDER BY t2.gender DESC, t2.lname ASC";
                                                        $result = mysqli_query($connect, $sql);
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            $middle_name = substr($row["mname"], 0, 1);
                                                ?>

                                                <tr>
                                                    <td class="text-center"> 
                                                        <?php echo $row["fname"] ?> <?php echo $middle_name ?>. <?php echo $row["lname"] ?> <?php echo $row["extension"]; ?>
                                                    </td>
                                                    <td class="text-center text-uppercase">
                                                        <?php echo $row["grade_level_section"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <!-- <button type="button" value="<?php echo $row["student_id"] ?>" class="viewStudentBtn btn btn-success btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </button> -->
                                                        <button type="button" value="<?php echo $row["student_id"] ?>" class="attendanceBtn btn btn-warning btn-sm">
                                                            <i class="fas fa-clipboard"></i> Attendance
                                                        </button>
                                                    </td>
                                                </tr>

                                                <?php 
                                                        }
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
    <?php //include 'include/profile_settings.php'; ?>

    <!-- Logout Modal-->
    <?php include 'include/logout.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- Alertify -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- View Attendance -->
    <div class="modal fade" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-light text-uppercase" id="exampleModalLabel">
                        student attendance
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="saveStudentAttendance" action="" method="POST">
                    <div class="modal-body">

                        <span ><i id="autosaved"></i>&nbsp</span>
                        <div id="load_attendance_sheet"></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function numbersonly(input) {
            var regex = /[^0-9]/g;
            input.value = input.value.replace(regex, "");
        }
    </script>

    <script type="text/javascript">
        //filter strand
        /*$(document).ready(function () {

            $('#student_attendance_filter').on('change', function () {

                var value = $(this).val();
                //alert(value);

                $.ajax({
                    url:"attendance-filter.php",
                    type:"POST",
                    data:'request=' + value,
                    success:function (data) {
                        $("#container").html(data);
                    }
                });

            });

        }); */
    </script>

    <script type="text/javascript">
        //view student 1
        $(document).on('click', '.attendanceBtn', function () {

            var student_id = $(this).val();
            //alert(student_id);  
            $.ajax({
                type: "POST",
                url: "load-attendance.php",
                data: {student_id: student_id},
                success: function (response) {
                    //alert(response);
                    /*var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);

                    }else if(res.status == 200){*/
                        $('#attendanceModal').modal('show');
                        $('#load_attendance_sheet').html(response);
                    //}

                }
            });

        });

        //add 1
        $(document).on('submit', '#saveStudentAttendance', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_attendance", true);

            $.ajax({
                type: "POST",
                url: "../action/code-save_attendance.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    //alert(response);        
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessage').addClass('d-none');
                        $('#attendanceModal').modal('hide');
                        $('#saveStudentAttendance')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });
    </script>

<!-- Bottom Section-->
<?php include 'include/botSection.php'; ?>