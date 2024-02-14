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
                        <h1 class="h3 mb-0 text-gray-800">MANAGE STUDENT GRADES</h1>
                    </div>

                    <!-- Content -->

                    <?php include 'include/form/form_student.php'; ?>

                    <div class="mt-4 mb-5">
                        <div class="card">
                            <div class="card-body">
                                
                                <!-- subject -->
                                <div class="col-md-4" id="strand_filters">
                                    <label class="text-uppercase font-weight-bolder">SELECT GRADE LEVEL</label>
                                        <select class="form-control text-capitalize" name="gradeLevelFilter" id="gradeLevelFilter">
                                            <option disabled selected> --- Select --- </option>
                                            <?php 
                                                $query = "SELECT * FROM tbl_grade_level ORDER BY grade_level";
                                                foreach ($connect->query($query) as $row) {      
                                            ?>

                                            <option class="text-capitalize" value="<?php echo $row['grade_level_id']; ?>"> 
                                                <?php echo $row['grade_level_section']; ?> 
                                            </option>

                                            <?php 
                                                }
                                            ?>
                                        </select>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="container-fluid mt-4 mb-5" id="container"></div>

                    
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

    <script>
        function numbersonly(input) {
            var regex = /[^0-9]/g;
            input.value = input.value.replace(regex, "");
        }
    </script>

    <script type="text/javascript">
        //filter strand
        $(document).ready(function () {

            $('#gradeLevelFilter').on('change', function () {

                var value = $(this).val();
                //alert(value);

                $.ajax({
                    url:"gradeLvl-filter.php",
                    type:"POST",
                    data:'request=' + value,
                    success:function (data) {
                        $("#container").html(data);
                    }
                });

            });

        }); 
    </script>

    <script type="text/javascript">
        //add
        $(document).on('submit', '#save_student', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_student", true);

            $.ajax({
                type: "POST",
                url: "action/code-student.php",
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
                        $('#addStudentModal').modal('hide');
                        $('#save_student')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

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
        $(document).on('click', '.editStudentBtn', function () {

            var student_id = $(this).val();
                    
            $.ajax({
                type: "GET",
                url: "action/code-student.php?student_id=" + student_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#student_id_e').val(res.data.student_id);
                        $('#lrn_e').val(res.data.lrn);
                        $('#fname_e').val(res.data.fname);
                        $('#mname_e').val(res.data.mname);
                        $('#lname_e').val(res.data.lname);
                        $('#extension_e').val(res.data.extension);
                        $('#gender_e').val(res.data.gender);
                        $('#birthdate_e').val(res.data.birthdate);

                        $('#editStudentModal').modal('show');
                    }

                }
            });

        });

        //update
        $(document).on('submit', '#update_student', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_student", true);

            $.ajax({
                type: "POST",
                url: "action/code-student.php",
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

                        $('#errorMessageUpdate').addClass('d-none');

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                                
                        $('#editStudentModal').modal('hide');
                        $('#update_student')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        //view
        $(document).on('click', '.viewStudentBtn', function () {

            var student_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "action/code-student.php?student_id=" + student_id,
                success: function (response) {
                  
                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){
                        
                        $('#lrn_v').val(res.data.lrn);
                        $('#fname_v').val(res.data.fname);
                        $('#mname_v').val(res.data.mname);
                        $('#lname_v').val(res.data.lname);
                        $('#extension_v').val(res.data.extension);
                        $('#gender_v').val(res.data.gender);
                        $('#birthdate_v').val(res.data.birthdate);

                        $('#viewStudentModal').modal('show');
                    }
                }
            });
        });

        //delete
        $(document).on('click', '.deleteStudentBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?')) {

                var student_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "action/code-student.php",
                    data: {
                        'delete_student': true,
                        'student_id': student_id
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