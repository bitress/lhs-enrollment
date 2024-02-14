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
                        <h1 class="h3 mb-0 text-gray-800">MANAGE GRADE LEVEL</h1>
                    </div>

                    <!-- Content -->

                    <?php include 'include/form/form_grade_level.php'; ?>

                    <div class="container mt-4 mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <h4><i class="fas fa-award"></i> List of Grade Level
                                          
                                            <button type="button" class="btn btn-primary float-right" id="addGradeLevelBtn">
                                                <i class="fas fa-plus"></i> Add Grade Level
                                            </button>
                                        </h4>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="myTable" class="table table-bordered table-hover">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th class="text-center"> Grade Level </th>
                                                    <th class="text-center"> Section/ STRAND </th>
                                                    <th class="text-center"> Adviser </th>
                                                    <th class="text-center"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    include 'connect.php';
                                                    $sql = "SELECT t2.*,  t1.grade_level_id, t1.grade_level, t1.section, t1.grade_level_section
                                                            FROM tbl_grade_level AS t1
                                                            INNER JOIN tbl_faculty AS t2 ON t2.faculty_id = t1.faculty_id
                                                            WHERE t1.status = 1";
                                                    $result = mysqli_query($connect, $sql);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $middle_name = substr($row["mname"], 0, 1);
                                                ?>

                                                <tr>
                                                    <td class="text-center">
                                                        <?php echo $row["grade_level"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row["section"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row["honorifics"] ?> <?php echo $row["fname"] ?> <?php echo $middle_name?>. <?php echo $row["lname"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <!--<button type="button" value="<?php //echo $row["grade_level_id"] ?>" class="viewSubjectBtn btn btn-success btn-sm"><i class="fas fa-eye"></i></button>-->
                                                        <button type="button" value="<?php echo $row["grade_level_id"] ?>" class="editGradeLevelBtn btn btn-warning btn-sm"><i class="fas fa-pen"></i></button>
                                                        <!-- <button type="button" value="<?php echo $row["grade_level_id"] ?>" class="deleteGradeLevelBtn btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button> -->
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
            $('#adviser_selector').select2();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#adviser_selector_e').select2();
        });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#addGradeLevelForm').hide();

        $('#addGradeLevelBtn').click(function() {
            $('#addGradeLevelForm').slideDown("slow");
        });

        $('#closeBtn').click(function() {
            $('#addGradeLevelForm').slideUp("slow");
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
        //add
        $(document).on('submit', '#save_grade_level', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_grade_level", true);

            $.ajax({
                type: "POST",
                url: "action/code-grade_level.php",
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
                            text: 'Grade Level Created Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            // After the alert is closed, reload the page
                            location.reload();
                        });

                        //$('#errorMessage').addClass('d-none');
                        //$('#addGradeLevelForm').hide();
                        //$('#save_grade_level')[0].reset();

                        //alertify.set('notifier','position', 'top-right');
                        //alertify.success(res.message);

                        //$('#myTable').load(location.href + " #myTable");

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
        $(document).on('click', '.editGradeLevelBtn', function () {

            var grade_level_id = $(this).val();
                    
            $.ajax({
                type: "GET",
                url: "action/code-grade_level.php?grade_level_id=" + grade_level_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#grade_level_id_e').val(res.data.grade_level_id);
                        $('#grade_level_e').val(res.data.grade_level);
                        $('#section_e').val(res.data.section);
                        $('#adviser_selector_e').val(res.data.adviser_selector);

                        $('#editGradeLevelForm').slideDown("slow");

                        $('#closeEditBtn').click(function() {
                            $('#editGradeLevelForm').slideUp("slow");
                        });
                    }

                }
            });

        });

        //update
        $(document).on('submit', '#update_grade_level', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_grade_level", true);

            $.ajax({
                type: "POST",
                url: "action/code-grade_level.php",
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
                                
                        //$('#editGradeLevelForm').hide();
                        //$('#update_grade_level')[0].reset();

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