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
                        <h1 class="h3 mb-0 text-gray-800">MANAGE FEE</h1>
                    </div>

                    <!-- Content -->

                    <?php include 'include/form/form_fee.php'; ?>

                    <div class="container mt-4 mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <h4><i class="fas fa-list"></i> List of Fees
                                          
                                            <button type="button" id="addOfferedSubjectBtn" class="btn btn-primary float-right">
                                                <i class="fas fa-plus"></i> Add fee
                                            </button>
                                        </h4>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="myTable" class="table table-bordered table-hover">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th class="text-center"> Fee Name </th>
                                                    <th class="text-center"> Grade Level </th>
                                                    <th class="text-center"> Collect </th>
                                                    <th class="text-center"> School Year </th>
                                                    <th class="text-center"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    include 'connect.php';
                                                    $sql = "SELECT * FROM `tbl_fee` WHERE status = 0";
                                                    $result = mysqli_query($connect, $sql);

                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $id = ($row["id"]);
                                                        $name = ($row["name"]);
                                                        $gradelevel = ($row["gradelevel"]);
                                                        $collect = number_format($row["collect"],2);
                                                        $schoolyear = ($row["schoolyear"]);

                                                ?>

                                                <tr>
                                                    <td class="text-center">
                                                        <?php echo $name ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $gradelevel ?> 
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $collect ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $schoolyear ?>
                                                    </td>
                                                    <td class="text-center">
                                                    <button type="button" value="<?= $id ?>" class="editFee btn btn-warning btn-sm"><i class="fas fa-pen"></i></button>
                                                
                                                   

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
        $(document).on('submit', '#save_fee', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_fee", true);

            //alert message
            //var confirmation = confirm("Created Successfully");

            $.ajax({
                type: "POST",
                url: "action/code-save-fee.php",
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



        $(document).on('click', '.deleteFees', function () {
        var feeid = $(this).val();
        $('#delete_fee_id').val(feeid)
        $('#deleteSaveFee').modal("show");

            //delete
            $(document).on('submit', '#delete_fee', function (e) {
                e.preventDefault();

                var formData = new FormData(this);
                formData.append("delete_fee", true);

                $.ajax({
                    type: "POST",
                    url: "action/code-save-fee.php",
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
                                text: 'Fee Deleted Successfully',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
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
        })


        $(document).on('click', '.editFee', function () {

        var feeid = $(this).val();
                
        $.ajax({
            type: "GET",
            url: "action/code-save-fee.php?edit_fee=" + feeid,
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if(res.status == 404) {

                    alert(res.message);
                }else if(res.status == 200){

                    $('#edit_fee_id').val(res.data.id);
                    $('#edit_fee_name').val(res.data.name);

                    $('#editSaveFee').modal("show");

                      
                       

                }

            }
        });
       


         //update
         $(document).on('submit', '#update_fee', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_fee", true);

            $.ajax({
                type: "POST",
                url: "action/code-save-fee.php",
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
                            text: 'Fee Updated Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
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



        });


        </script>

        
<!-- Bottom Section-->
<?php include 'include/botSection.php'; ?>