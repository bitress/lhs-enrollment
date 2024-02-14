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
                        <h1 class="h3 mb-0 text-gray-800">MANAGE OFFERED SUBJECT</h1>
                    </div>

                    <!-- Content -->

                    <?php include 'include/form/form_offered_subject.php'; ?>

                    <div class="container mt-4 mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <h4><i class="fas fa-book"></i> List of Subject Offered
                                          
                                            <button type="button" id="addOfferedSubjectBtn" class="btn btn-primary float-right">
                                                <i class="fas fa-plus"></i> Add Offered Subject
                                            </button>
                                        </h4>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="myTable" class="table table-bordered table-hover">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th class="text-center"> Teacher </th>
                                                    <th class="text-center"> Subject </th>
                                                    <th class="text-center"> Grade Level and Section </th>
                                                    <th class="text-center"> School Year </th>
                                                    <th class="text-center"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    include 'connect.php';
                                                    $sql = "SELECT t1.offered_subject_id, t2.faculty_id, t2.honorifics, t2.fname, t2.mname, t2.lname, t2.title, t3.subject_id, t3.subject_name, t4.grade_level_id, t4.grade_level, t4.section, t4.grade_level_section, t5.sy_id, t5.sy
                                                        FROM tbl_offered_subject AS t1
                                                        INNER JOIN tbl_faculty AS t2 ON t2.faculty_id = t1.faculty_id
                                                        INNER JOIN tbl_subject AS t3 ON t3.subject_id = t1.subject_id
                                                        INNER JOIN tbl_grade_level AS t4 ON t4.grade_level_id = t1.grade_level_id
                                                        INNER JOIN tbl_sy AS t5 ON t5.sy_id = t1.sy_id
                                                        WHERE t1.status = 1";
                                                    $result = mysqli_query($connect, $sql);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $middle_name = substr($row["mname"], 0, 1);
                                                ?>

                                                <tr>
                                                    <td class="text-center text-capitalize">
                                                        <?php echo $row["honorifics"] ?> <?php echo $row["fname"] ?> <?php echo $middle_name ?>. <?php echo $row["lname"] ?>, <?php echo $row["title"]; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row["subject_name"] ?>
                                                    </td>
                                                    <td class="text-center text-capitalize">
                                                        <?php echo $row["grade_level_section"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row["sy"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <!--<button type="button" value="<?php //echo $row["offered_subject_id"] ?>" class="viewSubjectBtn btn btn-success btn-sm"><i class="fas fa-eye"></i></button>-->
                                                        <button type="button" value="<?php echo $row["offered_subject_id"] ?>" class="editOfferedSubjectBtn btn btn-warning btn-sm"><i class="fas fa-pen"></i></button>
                                                        <button type="button" value="<?php echo $row["offered_subject_id"] ?>" class="deleteBtn btn btn-info btn-sm"><i class="fas fa-archive"></i></button>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#teacher_selector').select2();
            $('#subject_selector').select2();

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#teacher_selector_e').select2();

        });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#addOfferedSubjectForm').hide();

        $('#editOfferedSubjectForm').hide();

        $('#addOfferedSubjectBtn').click(function() {
            $('#addOfferedSubjectForm').slideDown("slow");
        });

        $('#closeBtn').click(function() {
            $('#addOfferedSubjectForm').slideUp("slow");
        });
    });
    </script>

    <script type="text/javascript">
        //add
        $(document).on('submit', '#save_offered_subject', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_offered_subject", true);

            //alert message
            //var confirmation = confirm("Created Successfully");

            $.ajax({
                type: "POST",
                url: "action/code-offered_subject.php",
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
                            text: 'Created Successfully',
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
        $(document).on('click', '.editOfferedSubjectBtn', function () {

            var offered_subject_id = $(this).val();
                    
            $.ajax({
                type: "GET",
                url: "action/code-offered_subject.php?offered_subject_id=" + offered_subject_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#offered_subject_id_e').val(res.data.offered_subject_id);
                        $('#teacher_selector_e').val(res.data.teacher_selector_e);
                        $('#subject_id_e').val(res.data.subject_id);
                        $('#grade_level_id_e').val(res.data.grade_level_id);
                        $('#sy_id_e').val(res.data.sy_id);
                        $('#hrsSem_e').val(res.data.hrsSem);
                        $('#hrsWeek_e').val(res.data.hrsWeek);

                        $('#editOfferedSubjectForm').slideDown("slow");

                        $('#closeEditBtn').click(function() {
                            $('#editOfferedSubjectForm').slideUp("slow");
                        });
                    }

                }
            });

        });

        //update
        $(document).on('submit', '#update_offered_subject', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_offered_subject", true);

            $.ajax({
                type: "POST",
                url: "action/code-offered_subject.php",
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
                            text: 'Information Updated Successfully',
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
                                
                        //$('#editOfferedSubjectForm').hide();
                        //$('#update_offered_subject')[0].reset();

                        //$('#myTable').load(location.href + " #myTable");

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

                        $('#viewSubjectModal').modal('show');
                    }
                }
            });
        });

        //delete
        $(document).on('click', '.deleteBtn', function (e) {
            e.preventDefault();

            var offered_subject_id = $(this).val();

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
                        url: "action/code-offered_subject.php",
                        data: {
                            'delete_offered_subject': true,
                            'offered_subject_id': offered_subject_id
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
                                    text: 'Record moved to Archive Successfully',
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