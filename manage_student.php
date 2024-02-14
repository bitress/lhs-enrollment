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
                        <h1 class="h3 mb-0 text-gray-800">MANAGE STUDENT</h1>
                    </div>

                    <!-- Content -->

                    <?php include 'include/form/form_student.php'; ?>

                    <div class="container mt-4 mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <h4><i class="fas fa-user"></i> Student List
                                          
                                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addStudentModal">
                                                <i class="fas fa-user-plus"></i> Add Student
                                            </button>
                                        </h4>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="myTable" class="table table-bordered table-hover">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th class="text-center"> LRN </th>
                                                    <th class="text-center"> Name </th>
                                                    <th class="text-center"> Age </th>
                                                    <th class="text-center"> Gender </th>
                                                    <th class="text-center"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    include 'connect.php';
                                                    $sql = "SELECT `student_id`, `lrn`, `fname`, `mname`, `lname`, `extension`, `gender`, `birthdate`, CURDATE(), TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) as `age`, `status`
                                                            FROM `tbl_student` WHERE `status` = 1";
                                                    $result = mysqli_query($connect, $sql);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $middle_name = substr($row["mname"], 0, 1);
                                                ?>

                                                <tr>
                                                    <td class="text-center">
                                                        <?php echo $row["lrn"] ?>
                                                    </td>
                                                    <td class="text-center"> 
                                                        <?php echo $row["fname"] ?> <?php echo $middle_name ?>. <?php echo $row["lname"] ?> <?php echo $row["extension"]; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row["age"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row["gender"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" value="<?php echo $row["student_id"] ?>" class="viewStudentBtn btn btn-success btn-sm"><i class="fas fa-eye"></i></button>
                                                        <button type="button" value="<?php echo $row["student_id"] ?>" class="editStudentBtn btn btn-warning btn-sm"><i class="fas fa-pen"></i></button>
                                                        <button type="button" value="<?php echo $row["student_id"] ?>" class="deleteStudentBtn btn btn-info btn-sm"><i class="fas fa-archive"></i></button>
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

    <!-- Include SweetAlert 2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>

    <!-- DataTable -->
    <script type="text/javascript">
        $(document).ready(function (){
            $('#myTable').DataTable();
        });
    </script>

    <script>
        function numbersonly(input) {
            var regex = /[^0-9]/g;
            input.value = input.value.replace(regex, "");
        }
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

                        //$('#errorMessage').addClass('d-none');
                        $('#addStudentModal').modal('hide');
                        //$('#save_student')[0].reset();

                        //alertify.set('notifier','position', 'top-right');
                        //alertify.success(res.message);

                        //$('#myTable').load(location.href + " #myTable");

                        Swal.fire({
                            //title: 'Hello SweetAlert 2!',
                            text: 'Student Record Created Successfully.',
                            icon: 'success',
                            timer: '1500',
                            //confirmButtonText: 'OK',
                            showConfirmButton: false
                        }).then(() => {
                            // After the alert is closed, reload the page
                            location.reload();
                        });

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
                        $('#prevschool_e').val(res.data.prevschool);
                        $('#address_e').val(res.data.address);
                        $('#pbirth_e').val(res.data.pbirth);
                        $('#cnumber_e').val(res.data.cnumber);
                        $('#schoolYear_e').val(res.data.schoolYear);
                        $('#f_fname_e').val(res.data.f_fname);
                        $('#f_mname_e').val(res.data.f_mname);
                        $('#f_lname_e').val(res.data.f_lname);
                        $('#f_extension_e').val(res.data.f_extension);
                        $('#f_occupation_e').val(res.data.f_occupation);
                        $('#m_fname_e').val(res.data.m_fname);
                        $('#m_mname_e').val(res.data.m_mname);
                        $('#m_lname_e').val(res.data.m_lname);
                        $('#m_extension_e').val(res.data.m_extension);
                        $('#m_occupation_e').val(res.data.m_occupation);

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

                        //$('#errorMessageUpdate').addClass('d-none');

                        //alertify.set('notifier','position', 'top-right');
                        //alertify.success(res.message);
                                
                        $('#editStudentModal').modal('hide');
                        //$('#update_student')[0].reset();

                        //$('#myTable').load(location.href + " #myTable");

                        Swal.fire({
                            //title: 'Hello SweetAlert 2!',
                            text: 'Student Information Updated Successfully.',
                            icon: 'success',
                            timer: '1500',
                            //confirmButtonText: 'OK',
                            showConfirmButton: false
                        }).then(() => {
                            // After the alert is closed, reload the page
                            location.reload();
                        });

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
                        $('#prevschool_v').val(res.data.prevschool);
                        $('#address_v').val(res.data.address);
                        $('#pbirth_v').val(res.data.pbirth);
                        $('#cnumber_v').val(res.data.cnumber);
                        $('#schoolYear_v').val(res.data.schoolYear);
                        $('#f_fname_v').val(res.data.f_fname);
                        $('#f_mname_v').val(res.data.f_mname);
                        $('#f_lname_v').val(res.data.f_lname);
                        $('#f_extension_v').val(res.data.f_extension);
                        $('#f_occupation_v').val(res.data.f_occupation);
                        $('#m_fname_v').val(res.data.m_fname);
                        $('#m_mname_v').val(res.data.m_mname);
                        $('#m_lname_v').val(res.data.m_lname);
                        $('#m_extension_v').val(res.data.m_extension);
                        $('#m_occupation_v').val(res.data.m_occupation);

                        $('#viewStudentModal').modal('show');
                    }
                }
            });
        });

        //delete
        $(document).on('click', '.deleteStudentBtn', function (e) {
            e.preventDefault();

            var student_id = $(this).val();

            // Show a SweetAlert with a message and a cancel button
            Swal.fire({
                //title: 'Do you want to proceed?',
                text: 'Are you sure you want to archive this data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0a8f17',
                cancelButtonColor: '#d11f1f',
                confirmButtonText: 'Ok',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "action/code-student.php",
                        data: {
                            'delete_student': true,
                            'student_id': student_id
                        },
                        success: function (response) {
                            //alert(success);
                            //var res = jQuery.parseJSON(response);
                            if(response == 'success') {
                                Swal.fire({
                                    //title: 'Hello SweetAlert 2!',
                                    text: 'Action Failed',
                                    icon: 'error',
                                    timer: '1500',
                                    //confirmButtonText: 'OK',
                                    showConfirmButton: false
                                });
                            }else{
                                Swal.fire({
                                    //title: 'Hello SweetAlert 2!',
                                    text: 'Student Record moved to Archive Successfully',
                                    icon: 'success',
                                    timer: '1500',
                                    //confirmButtonText: 'OK',
                                    showConfirmButton: false
                                }).then(() => {
                                    // After the alert is closed, reload the page
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });
            
        });
    </script>

<!-- Bottom Section-->
<?php include 'include/botSection.php'; ?>