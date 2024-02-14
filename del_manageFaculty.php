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
                        <h1 class="h3 mb-0 text-gray-800">ARCHIVED FACULTY RECORD</h1>
                    </div>

                    <!-- Content -->

                    <?php include 'include/form/form_faculty.php'; ?>

                    <div class="container mt-4 mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <h4><i class="fas fa-users"></i> Faculty List
                                          
                                            <!-- <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addFacultyModal">
                                                <i class="fas fa-user-plus"></i> Add Faculty
                                            </button> -->
                                        </h4>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="myTable" class="table table-bordered table-hover">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th class="text-center"> Name </th>
                                                    <th class="text-center"> Age </th>
                                                    <th class="text-center"> Position </th>
                                                    <th class="text-center"> Username </th>
                                                    <th class="text-center"> User Type </th>
                                                    <th class="text-center"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    include 'connect.php';
                                                    $sql = "SELECT `faculty_id`, `honorifics`, `fname`, `mname`, `lname`, `title`, `position`, `birthdate`, CURDATE(), TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) as `age`, `email`, `username`, `password`, `userType`
                                                            FROM `tbl_faculty` WHERE `status` = 0 AND `faculty_id` != 1";
                                                    $result = mysqli_query($connect, $sql);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $middle_name = substr($row["mname"], 0, 1);
                                                ?>

                                                <tr>
                                                    <td class="text-center text-capitalize"> 
                                                        <?php echo $row["honorifics"] ?> <?php echo $row["fname"] ?> <?php echo $middle_name ?>. <?php echo $row["lname"] ?>, <?php echo $row["title"]; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row["age"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row["position"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row["username"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row["userType"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <!-- <button type="button" value="<?php echo $row["faculty_id"] ?>" class="viewFacultyBtn btn btn-success btn-sm"><i class="fas fa-eye"></i></button> -->
                                                        <!-- <button type="button" value="<?php echo $row["faculty_id"] ?>" class="editFacultyBtn btn btn-warning btn-sm"><i class="fas fa-pen"></i></button> -->
                                                        <button type="button" value="<?php echo $row["faculty_id"] ?>" class="restoreFacultyBtn btn btn-success btn-sm"><i class="fas fa-undo"></i></button>
                                                        <button type="button" value="<?php echo $row["faculty_id"] ?>" class="delFacultyBtn btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
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
        //restore
        $(document).on('click', '.restoreFacultyBtn', function (e) {
            e.preventDefault();

            var faculty_id = $(this).val();

            // Show a SweetAlert with a message and a cancel button
            Swal.fire({
                //title: 'Do you want to proceed?',
                text: 'Are you sure you want to restore this data?',
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
                        url: "action/code-faculty.php",
                        data: {
                            'restore_faculty': true,
                            'faculty_id': faculty_id
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
                                    text: 'Faculty Record Restored Successfully',
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

        //delete
        $(document).on('click', '.delFacultyBtn', function (e) {
            e.preventDefault();

            var faculty_id = $(this).val();

            // Show a SweetAlert with a message and a cancel button
            Swal.fire({
                //title: 'Do you want to proceed?',
                text: 'Are you sure you want to delete this data?',
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
                        url: "action/code-del-archive-faculty.php",
                        data: {
                            'del_faculty': true,
                            'faculty_id': faculty_id
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
                                    text: 'Record Deleted Successfully',
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