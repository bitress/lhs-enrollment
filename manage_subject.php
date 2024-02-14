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
                        <h1 class="h3 mb-0 text-gray-800">MANAGE SUBJECT</h1>
                    </div>

                    <!-- Content -->

                    <?php include 'include/form/form_subject.php'; ?>

                    <div class="container mt-4 mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <h4><i class="fas fa-book"></i> Subject List
                                          
                                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addSubjectModal">
                                                <i class="fas fa-plus"></i> Add Subject
                                            </button>
                                        </h4>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="myTable" class="table table-bordered table-hover">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th class="text-center"> Subject Code </th>
                                                    <th class="text-center"> Subject Name </th>
                                                    <th class="text-center"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    include 'connect.php';
                                                    $sql = "SELECT `subject_id`, `subject_name`, `subject_code`, `status`
                                                            FROM `tbl_subject` WHERE `status` = 1";
                                                    $result = mysqli_query($connect, $sql);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                ?>

                                                <tr>
                                                    <td class="text-center">
                                                        <?php echo $row["subject_code"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row["subject_name"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" value="<?php echo $row["subject_id"] ?>" class="viewSubjectBtn btn btn-success btn-sm"><i class="fas fa-eye"></i></button>
                                                        <button type="button" value="<?php echo $row["subject_id"] ?>" class="editSubjectBtn btn btn-warning btn-sm"><i class="fas fa-pen"></i></button>
                                                        <button type="button" value="<?php echo $row["subject_id"] ?>" class="deleteSubjectBtn btn btn-info btn-sm"><i class="fas fa-archive"></i></button>
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

    <script type="text/javascript">
        //add
        $(document).on('submit', '#save_subject', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_subject", true);

            $.ajax({
                type: "POST",
                url: "action/code-subject.php",
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
                        $('#addSubjectModal').modal('hide');
                        //$('#save_subject')[0].reset();

                        //alertify.set('notifier','position', 'top-right');
                        //alertify.success(res.message);

                        //$('#myTable').load(location.href + " #myTable");

                        Swal.fire({
                            //title: 'Hello SweetAlert 2!',
                            text: 'Subject Created Successfully.',
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
        $(document).on('click', '.editSubjectBtn', function () {

            var subject_id = $(this).val();
                    
            $.ajax({
                type: "GET",
                url: "action/code-subject.php?subject_id=" + subject_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#subject_id_e').val(res.data.subject_id);
                        $('#subject_name_e').val(res.data.subject_name);
                        $('#subject_code_e').val(res.data.subject_code);

                        $('#editSubjectModal').modal('show');
                    }

                }
            });

        });

        //update
        $(document).on('submit', '#update_subject', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_subject", true);

            $.ajax({
                type: "POST",
                url: "action/code-subject.php",
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
                                
                        $('#editSubjectModal').modal('hide');
                        //$('#update_subject')[0].reset();

                        //$('#myTable').load(location.href + " #myTable");

                        Swal.fire({
                            //title: 'Hello SweetAlert 2!',
                            text: 'Subject Information Updated Successfully.',
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
        $(document).on('click', '.viewSubjectBtn', function () {

            var subject_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "action/code-subject.php?subject_id=" + subject_id,
                success: function (response) {
                  
                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){
                        
                        $('#subject_name_v').val(res.data.subject_name);
                        $('#subject_code_v').val(res.data.subject_code);

                        $('#viewSubjectModal').modal('show');
                    }
                }
            });
        });

        //delete
        $(document).on('click', '.deleteSubjectBtn', function (e) {
            e.preventDefault();

            var subject_id = $(this).val();

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
                        url: "action/code-subject.php",
                        data: {
                            'delete_subject': true,
                            'subject_id': subject_id
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
                                    text: 'Subject Record moved to Archive Successfully',
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