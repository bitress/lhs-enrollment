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
                        <h1 class="h3 mb-0 text-gray-800">STUDENT ENROLLMENT</h1>
                    </div>

                    <!-- Content -->

                    <?php include 'include/form/form_enrollment.php'; ?>

                    <div class="container mt-4 mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <h4><i class="fas fa-award"></i> Enrollment
                                          
                                            <button type="button" class="btn btn-primary float-right" id="enrollmentBtn">
                                                <i class="fas fa-plus"></i> Enroll Student
                                            </button>
                                        </h4>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="myTable" class="table table-bordered table-hover">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th class="text-center"> lrn </th>
                                                    <th class="text-center"> Student Name </th>
                                                    <th class="text-center"> Grade Level & Section/ STRAND </th>
                                                    <th class="text-center"> Date of Enrollment </th>
                                                    <th class="text-center"> School Year </th>
                                                    <th class="text-center"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    include 'connect.php';
                                                    $sql = "SELECT t1.*, t2.*, t3.*, t4.*
                                                            FROM tbl_enrollment AS t1
                                                            INNER JOIN tbl_student AS t2 ON t2.student_id = t1.student_id
                                                            INNER JOIN tbl_grade_level AS t3 ON t3.grade_level_id = t1.grade_level_id
                                                            INNER JOIN tbl_sy AS t4 ON t4.sy_id = t1.sy_id
                                                            WHERE t1.status = 1";
                                                    $result = mysqli_query($connect, $sql);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $middle_name = substr($row["mname"], 0, 1);
                                                ?>

                                                <tr>
                                                    <td class="text-center">
                                                        <?php echo $row["lrn"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row["fname"] ?> <?php echo $middle_name?>. <?php echo $row["lname"] ?> <?php echo $row["extension"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row["grade_level_section"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row["date_of_enrollment"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row["sy"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <!-- <form action="printing.php" method="POST">
                                                            <input type="hidden" name="enrollment_id" value="<?php echo $row["enrollment_id"] ?>">
                                                            <button type="submit" class="btn btn-primary btn-sm" name="printEnrollment">
                                                                <i class="fas fa-print me-1"></i> Print
                                                            </button>
                                                        </form> -->
                                                        <!--<button type="button" value="<?php //echo $row["grade_level_id"] ?>" class="viewSubjectBtn btn btn-success btn-sm"><i class="fas fa-eye"></i></button>-->
                                                        <a href="printing_reports.php?enrollment_id=<?php echo $row['enrollment_id'] ?>" target="_blank" style="text-decoration: none;" class="btn btn-primary btn-sm">
                                                            <i class="fas fa-print"></i>
                                                        </a>
                                                        <button type="button" value="<?php echo $row["enrollment_id"] ?>" class="editEnrollmentBtn btn btn-warning btn-sm"><i class="fas fa-pen"></i></button>
                                                        <!-- <button type="button" value="<?php echo $row["enrollment_id"] ?>" class="deleteGradeLevelBtn btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button> -->
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
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#student_selector').select2();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#adviser_selector_e').select2();
        });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#enrollmentForm').hide();

        $('#enrollmentBtn').click(function() {
            $('#enrollmentForm').slideDown("slow");
        });

        $('#closeBtn').click(function() {
            $('#enrollmentForm').slideUp("slow");
        });
    });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#editGradeLevelForm').hide();

        $('#editGradeLevelBtn').click(function() {
            $('#editGradeLevelForm').slideDown("slow");
        });

        $('#closeEditBtn').click(function() {
            $('#editGradeLevelForm').slideUp("slow");
        });
    });
    </script>

    <script>
        function numbersonly(input) {
            var regex = /[^0-9]/g;
            input.value = input.value.replace(regex, "");
        }
    </script>

    <script type="text/javascript">
        //select student
        $('#student_selector').on('change', function(){
            var lrn = $('#student_selector').find(":selected").val();
            //alert(lrn);
            $.ajax({
                type: "POST",
                url: 'get_lrn.php',
                data: {lrn: lrn},
                success: function(data){
                    $("#lrn1").html(data);
                }
            })
        });

        //show list of subject
        $("#grade_level_section_selector").on('change', function(){
            var grade_level_section = $('#grade_level_section_selector').find(":selected").val();
            //alert(grade_level_section);
            $.ajax({
                type: "POST",
                url: 'get_subject.php',
                data: {grade_level_section: grade_level_section},
                success: function(data){
                    $("#subjects1").html(data);
                }
            })
        });

        //show list of subject on edit enrollment information
        $("#grade_level_section_selector_e").on('change', function(){
            var grade_level_section = $('#grade_level_section_selector_e').find(":selected").val();
            //alert(grade_level_section);
            $.ajax({
                type: "POST",
                url: 'get_subject.php',
                data: {grade_level_section: grade_level_section},
                success: function(data){
                    $("#subject_e").html(data);
                }
            })
        });
    </script>

    <script type="text/javascript">
        //add
        $(document).on('submit', '#save_enrollment', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_enrollment", true);

            //alert message
            //var confirmation = confirm("Student Enroll Successfully");

            $.ajax({
                type: "POST",
                url: "action/code-enrollment.php",
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

                        Swal.fire({
                            //title: 'Hello SweetAlert 2!',
                            text: 'Student Enroll Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            // After the alert is closed, reload the page
                            location.reload();
                        });

                        /*if (confirmation) {
                            //refresh window
                            window.location.reload();
                        }*/

                    }else if(res.status == 500) {
                        alert(res.message);
                    }else if(res.status == 322) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);
                    }
                }
            });

        });

        //edit
        $(document).on('click', '.editEnrollmentBtn', function () {

            var enrollment_id = $(this).val();
                    
            $.ajax({
                type: "GET",
                url: "action/code-enrollment.php?enrollment_id=" + enrollment_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#student_id_e').val(res.data.student_id);
                        $('#enrollment_id_e').val(res.data.enrollment_id);
                        $('#student_name_e').val(res.data.student_name);
                        $('#lrn_e').val(res.data.lrn);
                        $('#grade_level_section_selector_e').val(res.data.grade_level_id);
                        $('#sy_e').val(res.data.sy_id);
                        $('#subject_e').val(res.data.subject_id);

                        $('#editEnrollmentForm').modal("show");
                        $(document).click();

                            var grade_level_section = $('#grade_level_section_selector_e').find(":selected").val();
                            //alert(grade_level_section);
                            $.ajax({
                                type: "POST",
                                url: 'get_subject.php',
                                data: {grade_level_section: grade_level_section},
                                success: function(data){
                                    $("#subject_e").html(data);
                                }
                            });

                    }

                }
            });

        });

        //update
        $(document).on('submit', '#update_enrollment', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_enrollment", true);

            $.ajax({
                type: "POST",
                url: "action/code-enrollment.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    //alert(response);
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    }else if(res.status == 200){

                        Swal.fire({
                            //title: 'Hello SweetAlert 2!',
                            text: 'Enrollment Information Updated Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            // After the alert is closed, reload the page
                            location.reload();
                        });

                        //$('#errorMessageUpdate').addClass('d-none');

                        //alertify.set('notifier','position', 'top-right');
                        //alertify.success(res.message);
                                
                        //$('#editEnrollmentForm').modal('hide');
                        //$('#update_enrollment')[0].reset();

                        //$('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        //view
        $(document).on('click', '.viewSubjectBtn', function () {

            var grade_level_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "action/code-subject.php?grade_level_id=" + grade_level_id,
                success: function (response) {
                  
                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){
                        
                        $('#subject_name_v').val(res.data.subject_name);

                        $('#viewSubjectModal').modal('show');
                    }
                }
            });
        });

        //delete
        $(document).on('click', '.deleteGradeLevelBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?')) {

                var grade_level_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "action/code-grade_level.php",
                    data: {
                        'delete_grade_level': true,
                        'grade_level_id': grade_level_id
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if(res.status == 500) {

                            alert(res.message);
                        }else{
                            alertify.set('notifier','position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable').load(location.href + " #myTable");
                        }
                    }
                });

            }

        });
    </script>

<!-- Bottom Section-->
<?php include 'include/botSection.php'; ?>