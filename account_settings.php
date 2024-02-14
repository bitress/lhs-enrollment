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
                        <h1 class="h3 mb-0 text-gray-800">Account Settings</h1>
                    </div>

                    <?php include 'include/form/form_account_settings.php'; ?>

                    <div class="alert alert-light text-uppercase text-dark font-weight-bolder border mb-3">
                        <div class="">
                            user information 
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        
                        <?php

                            if(isset($_SESSION['faculty_id'])){

                                $faculty_id=$_SESSION['faculty_id'];
                                             
                                //include_once "connect.php";
                                $sql_profile = "SELECT `faculty_id`, `honorifics`, `fname`, `mname`, `lname`, `gender`, `title`, `position`, DATE_FORMAT(`birthdate`,'%M %e, %Y') AS 'birthdate', `email`, `username`, `password`, `image`, `userType`, `status` 
                                FROM `tbl_faculty`
                                WHERE `faculty_id`=$faculty_id";
                                $result_profile = mysqli_query($connect, $sql_profile);

                                if (mysqli_num_rows($result_profile) > 0) {
                                    while($row = mysqli_fetch_array($result_profile)) {
                                        $middle_name = substr($row["mname"], 0, 1);
                        ?>

                        <!-- Profile Image -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <!-- User Profile Image -->
                                    <img src="profile_image/<?php echo $row['image']; ?>" class="img-thumbnail rounded mx-auto d-block" style="height: 250px; width: 250px;">

                                    <input type="hidden" value="<?php echo $row['faculty_id']; ?>" readonly>

                                    <center>
                                        <button type="button" class="btn btn-info btn-sm btn-block mt-2 text-uppercase font-weight-bolder btn_upload_img" style="width: 250px;" data-toggle="modal" data-target="#uploadProfileModal" value="<?php echo $row['faculty_id']; ?>">
                                            <i class="fas fa-image"></i> Change Profile Image
                                        </button>
                                    </center>

                                </div>
                            </div>
                        </div>

                        <!-- User Info -->
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    

                                    <!-- User Information -->
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label class="text-uppercase font-weight-bolder">Name</label>
                                                <input type="text" class="form-control" 
                                                value="<?php echo $row['honorifics']; ?> <?php echo $row['fname']; ?> <?php echo $middle_name; ?>. <?php echo $row['lname']; ?>, <?php echo $row['title']; ?>" 
                                                disabled>
                                            </div>

                                            <div class="form-group">
                                                <label class="text-uppercase font-weight-bolder">Birthdate</label>
                                                <input type="text" class="form-control" 
                                                value="<?php echo $row['birthdate']; ?>" 
                                                disabled>
                                            </div>

                                            <div class="form-group">
                                                <label class="text-uppercase font-weight-bolder">Gender</label>
                                                <input type="text" class="form-control" 
                                                value="<?php echo $row['gender']; ?>" 
                                                disabled>
                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label class="text-uppercase font-weight-bolder">Position</label>
                                                <input type="text" class="form-control" 
                                                value="<?php echo $row['position']; ?>" 
                                                disabled>
                                            </div>

                                            <div class="form-group">
                                                <label class="text-uppercase font-weight-bolder">Username</label>
                                                <input type="text" class="form-control" 
                                                value="<?php echo $row['username']; ?>" 
                                                disabled>
                                            </div>

                                            <div class="form-group">
                                                <label class="text-uppercase font-weight-bolder">User Type</label>
                                                <input type="text" class="form-control" 
                                                value="<?php echo $row['userType']; ?>" 
                                                disabled>
                                            </div>

                                        </div>

                                    </div>

                                    <button type="button" class="btn btn-warning btn-sm text-uppercase font-weight-bolder float-right editFacultyBtn" value="<?php echo $row['faculty_id']; ?>">
                                        <i class="fas fa-pen"></i> edit information 
                                    </button>

                                    <button type="button" class="btn btn-info btn-sm text-uppercase font-weight-bolder float-right mr-2 change_pass_btn" value="<?php echo $row['faculty_id']; ?>">
                                        <i class="fas fa-lock"></i> change password 
                                    </button>

                                </div>
                            </div>
                        </div>

                        <?php
                                    }
                                }
                            }
                        ?>

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
    
    <script type="text/javascript">
        //profile preview
        function imagePreview(fileInput) {
            if (fileInput.files && fileInput.files[0]) {
                var fileReader = new FileReader();
                fileReader.onload = function (event) {
                    $('#preview').html('<img src="'+event.target.result+'" style="height: 250px; width: 250px;" class="img-thumbnail rounded mx-auto d-block"/>');
                };
                fileReader.readAsDataURL(fileInput.files[0]);
            }
        }

        $("#image").change(function () {
            imagePreview(this);
        });
    </script>

    <script type="text/javascript">
        //==== user profile image ====//
        //edit
        $(document).on('click', '.btn_upload_img', function () {

            var faculty_id = $(this).val();
                    
            $.ajax({
                type: "GET",
                url: "action/code-account_settings.php?faculty_id=" + faculty_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#faculty_id_e').val(res.data.faculty_id);
                        //$('#sy_e').val(res.data.sy);

                        $('#uploadProfileModal').modal('show');
                    }

                }
            });

        });

        //update
        $(document).on('submit', '#save_img', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_img", true);

            $.ajax({
                type: "POST",
                url: "action/code-account_settings.php",
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
                                
                        $('#uploadProfileModal').modal('hide');
                        //$('#save_img')[0].reset();

                        //$('#myTable').load(location.href + " #myTable");

                        Swal.fire({
                            //title: 'Hello SweetAlert 2!',
                            text: 'Profile Image Successfully Save.',
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

        //==== user information ====//
        //edit
        $(document).on('click', '.editFacultyBtn', function () {

            var faculty_id = $(this).val();
                    
            $.ajax({
                type: "GET",
                url: "action/code-account_settings.php?faculty_id=" + faculty_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#faculty_id_ee').val(res.data.faculty_id);
                        $('#honorifics_e').val(res.data.honorifics);
                        $('#fname_e').val(res.data.fname);
                        $('#mname_e').val(res.data.mname);
                        $('#lname_e').val(res.data.lname);
                        $('#title_e').val(res.data.title);
                        $('#gender_e').val(res.data.gender);
                        $('#birthdate_e').val(res.data.birthdate);
                        $('#position_e').val(res.data.position);
                        $('#username_e').val(res.data.username);
                        $('#email_e').val(res.data.email);
                        //$('#password_e').val(res.data.password);
                        //$('#userType_e').val(res.data.userType);

                        $('#editFacultyModal').modal('show');
                    }

                }
            });

        });

        //update
        $(document).on('submit', '#update_faculty', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_faculty", true);

            $.ajax({
                type: "POST",
                url: "action/code-account_settings.php",
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
                                
                        $('#editFacultyModal').modal('hide');
                        //$('#update_faculty')[0].reset();

                        //$('#myTable').load(location.href + " #myTable");

                        Swal.fire({
                            //title: 'Hello SweetAlert 2!',
                            text: 'User Information Updated Successfully.',
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

        //==== change password ====//
        //get id
        $(document).on('click', '.change_pass_btn', function () {

            var faculty_id = $(this).val();
                    
            $.ajax({
                type: "GET",
                url: "action/code-account_settings.php?faculty_id=" + faculty_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#faculty_id_eee').val(res.data.faculty_id);
                        //$('#sy_e').val(res.data.sy);

                        $('#changePassModal').modal('show');
                    }

                }
            });

        });

        //save change password
        $(document).on('submit', '#updatePassword', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("updatePassword", true);

            $.ajax({
                type: "POST",
                url: "action/code-account_settings.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    //alert(response);
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    }else if(res.status == 230){

                        //$('#errorMessageUpdate').addClass('d-none');

                        //alertify.set('notifier','position', 'top-right');
                        //alertify.success(res.message);
                                
                        $('#changePassModal').modal('hide');
                        //$('#updatePassword')[0].reset();

                        //$('#myTable').load(location.href + " #myTable");
                        //$('#informationTab').load(location.href + " #informationTab");

                        Swal.fire({
                            //title: 'Hello SweetAlert 2!',
                            text: 'Password Changed Successfully.',
                            icon: 'success',
                            timer: '1500',
                            //confirmButtonText: 'OK',
                            showConfirmButton: false
                        }).then(() => {
                            // After the alert is closed, reload the page
                            location.reload();
                        });

                    }else if(res.status == 530) {
                        //alert(res.message);

                        Swal.fire({
                            //title: 'Hello SweetAlert 2!',
                            text: 'Password Failed to Update.',
                            icon: 'error',
                            timer: '1500',
                            //confirmButtonText: 'OK',
                            showConfirmButton: false
                        }).then(() => {
                            // After the alert is closed, reload the page
                            location.reload();
                        });

                    }else if(res.status == 630) {
                        //alert(res.message);

                        Swal.fire({
                            //title: 'Hello SweetAlert 2!',
                            text: 'Old Password does not match in our database.',
                            icon: 'error',
                            timer: '1500',
                            //confirmButtonText: 'OK',
                            showConfirmButton: false
                        }).then(() => {
                            // After the alert is closed, reload the page
                            location.reload();
                        });

                    }else if(res.status == 730) {
                        //alert(res.message);

                        Swal.fire({
                            //title: 'Hello SweetAlert 2!',
                            text: 'Password did not match.',
                            icon: 'error',
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

        });
    </script>

<!-- Bottom Section-->
<?php include 'include/botSection.php'; ?>