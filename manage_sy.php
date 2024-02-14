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
                        <h1 class="h3 mb-0 text-gray-800">MANAGE SCHOOL YEAR</h1>
                    </div>

                    <!-- Content -->

                    <?php include 'include/form/form_sy.php'; ?>

                    <div class="container mt-4 mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <h4><i class="fas fa-calendar"></i> School Year
                                          
                                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addSYModal">
                                                <i class="fas fa-plus"></i> New School Year
                                            </button>
                                        </h4>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="myTable" class="table table-bordered table-hover">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th class="text-center"> School Year </th>
                                                    <th class="text-center"> Status </th>
                                                    <th class="text-center"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    include 'connect.php';
                                                    $sql = "SELECT * FROM `tbl_sy`";
                                                    $result = mysqli_query($connect, $sql);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                ?>

                                                <tr>
                                                    <td class="text-center">
                                                        <?php echo $row["sy"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                            if ($row['sy_status'] == 1) {
                                                              echo '<a href="action/code-change_sy_status.php?sy_id='.$row['sy_id'].'&sy_status=0">
                                                                        <i class="fas fa-toggle-on" style="color: green;"></i>
                                                                    </a>';  
                                                            }else{
                                                                echo '<a href="action/code-change_sy_status.php?sy_id='.$row['sy_id'].'&sy_status=1">
                                                                        <i class="fas fa-toggle-off" style="color: red;"></i>
                                                                        </a>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <!--<button type="button" value="<?php //echo $row["sy_id"] ?>" class="viewSubjectBtn btn btn-success btn-sm"><i class="fas fa-eye"></i></button>-->
                                                        <button type="button" value="<?php echo $row["sy_id"] ?>" class="editSYBtn btn btn-warning btn-sm"><i class="fas fa-pen"></i></button>
                                                        <!--<button type="button" value="<?php //echo $row["sy_id"] ?>" class="deleteSubjectBtn btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>-->
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

    <!-- DataTable -->
    <script type="text/javascript">
        $(document).ready(function (){
            $('#myTable').DataTable();
        });
    </script>

    <script type="text/javascript">
        //add
        $(document).on('submit', '#save_sy', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sy", true);

            $.ajax({
                type: "POST",
                url: "action/code-sy.php",
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
                        $('#addSYModal').modal('hide');
                        $('#save_sy')[0].reset();

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
        $(document).on('click', '.editSYBtn', function () {

            var sy_id = $(this).val();
                    
            $.ajax({
                type: "GET",
                url: "action/code-sy.php?sy_id=" + sy_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#sy_id_e').val(res.data.sy_id);
                        $('#sy_e').val(res.data.sy);

                        $('#editSYModal').modal('show');
                    }

                }
            });

        });

        //update
        $(document).on('submit', '#update_sy', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_sy", true);

            $.ajax({
                type: "POST",
                url: "action/code-sy.php",
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
                                
                        $('#editSYModal').modal('hide');
                        $('#update_sy')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        //view
        $(document).on('click', '.viewSubjectBtn', function () {

            var sy_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "action/code-subject.php?sy_id=" + sy_id,
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
        $(document).on('click', '.deleteSubjectBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?')) {

                var sy_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "action/code-subject.php",
                    data: {
                        'delete_subject': true,
                        'sy_id': sy_id
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