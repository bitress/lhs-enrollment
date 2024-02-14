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
                        <h1 class="h3 mb-0 text-gray-800">MANAGE PAYMENT</h1>
                    </div>

                    <!-- Content -->
<!--                    --><?php //include 'include/form/form_payments.php'; ?>


                    <div class="container mt-4 mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <h4><i class="fas fa-award"></i> Payment
                                        </h4>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="myTable" class="table table-bordered table-hover">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th class="text-center"> LRN </th>
                                                    <th class="text-center"> Student Name </th>
                                                    <th class="text-center"> Grade Level & Section/ STRAND </th>
                                                    <th class="text-center"> School Year </th>
                                                    <th class="text-center"> Total Balance </th>
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
                                                        $grade_level = $row['grade_level'];
                                                        $sy = $row['sy'];
                                                        $enrollment_id = $row['enrollment_id'];


                                                        // ============COLLECTION PAYMENT====================//
                                                       
                                                        $collectionSql = "SELECT SUM(a.collect) as collection FROM tbl_fee as a 
                                                        WHERE a.gradelevel = '$grade_level' 
                                                        AND a.schoolyear = '$sy'";
                                                        $result2 = mysqli_query($connect, $collectionSql);
                                                        $collection = mysqli_fetch_assoc($result2)['collection'];
                                                        $collection = $collection>1 ? $collection : 0;
                                                    // ============PAYMENTS====================//
                                                        $paymentSql = "SELECT *,SUM(payment) as totalpayment FROM `tbl_payments` WHERE `enrollment_id` = '$enrollment_id'";
                                                        $result3 = mysqli_query($connect, $paymentSql);
                                                        $payment = mysqli_fetch_assoc($result3)['totalpayment'];
                                                        $payment = $payment>1 ? $payment : 0;   

                                                        $totalbal = $collection-$payment;

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
                                                        <?php echo $row["sy"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        P<?php echo number_format($totalbal,2) ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <?php
                                                            if($totalbal>0){
                                                                echo ' <button class="btn btn-sm btn-outline-info addpaymentBtn" data-toggle="modal" data-target="#exampleModal" data-gradelevel="'.$grade_level.'"
                                                            data-schoolyear="'.$sy.'"
                                                            data-enrollmentid="'.$enrollment_id.'"
                                                            ><i class="fal fa-cash-register"></i>&nbsp; Process Payment</button>';
                                                            }
                                                            ?>
                                                        </div>

                                                      
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



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="student_nameModalTitle">Process Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="save_payment">
                        <input type="hidden" name="enrollment_id" id="enrollment_id">
                        <input type="hidden" name="schoolyear" id="schoolyear">
                    <h3>Student Info</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="studentLRN">LRN</label>
                                <input type="text" readonly id="studentLRN" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="studentName">Name</label>
                                <input type="text" readonly id="studentName" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="studentGradeLevel">Grade Level & Section/Strand</label>
                                <input type="text" readonly id="studentGradeLevel" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="studentSchoolYear">School Year</label>
                                <input type="text" readonly id="studentSchoolYear" class="form-control">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h3>Student Balance</h3>
                    <div class="row">


                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="studentTotalBalance">Total Balance</label>
                                <input type="text" readonly id="studentTotalBalance" class="form-control">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="dateProcess">Date Processed</label>
                                <input type="datetime-local" name="dateProcess" id="dateProcess" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="ORNumber">OR Number</label>
                                <input type="number" name="ORNumber" id="ORNumber" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="studentPayment">Payment</label>
                                <input type="text" name="studentPayment"  id="studentPayment" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <button type="button" id="processPaymentBtn" class="btn btn-success">Process Payment</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


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
        $('#myTable').on('click', '.addpaymentBtn', function() {
            var gradelevel = $(this).data('gradelevel')
            var schoolyear = $(this).data('schoolyear')
            var enrollmentid = $(this).data('enrollmentid')
            $('#enrollment_id').val(enrollmentid)
            $('#schoolyear').val(schoolyear)

            $.ajax({
                type: "POST",
                url: 'action/code-payment.php',
                data: { gradelevel: gradelevel, schoolyear: schoolyear, enrollmentid: enrollmentid },
                success: function(data) {
                    var response = JSON.parse(data);
                    console.log(response);

                    var studentInfo = response.student_info[0];
                    $('#studentLRN').val(studentInfo.lrn);
                    $('#studentName').val(studentInfo.fname + ' ' + studentInfo.lname);
                    $('#studentGradeLevel').val(studentInfo.grade_level);
                    $('#studentSchoolYear').val(studentInfo.schoolYear);

                    var enrollmentInfo = response.enrollment_info[0];
                    $('#enrollment_id').val(enrollmentInfo.enrollment_id);

                    $('#studentTotalBalance').val(response.totalBalance.toFixed(2));


                    // var feesInfo = response.fees_info;
                    // $.each(feesInfo, function(index, fee) {
                    //     var feeIdInput = $('<input>').attr({ type: 'hidden', name: 'feeid[]', value: 0, class: 'form-control'});
                    //     var paymentInput = $('<input>').attr({ type: 'hidden', name: 'payment[]', placeholder: 'Payment Amount', value: 0, class: 'form-control'});
                    //     $('#feesContainer').append( feeIdInput, paymentInput);
                    // });


                    // var totalBalance = 0;
                    // $.each(response.fees_info, function(index, fee) {
                    //     totalBalance += parseFloat(fee.collect);
                    // });
                    // $('#studentTotalBalance').val(totalBalance.toFixed(2));

                    $('#paymentModal').modal('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error: " + textStatus, errorThrown);
                }
            });



        });


    
    });
</script>
<script type="text/javascript">
    $(document).on('click', '#processPaymentBtn', function (e) {
        e.preventDefault();

        var form = $('#save_payment')[0]; // Get the form element
        var formData = new FormData(form);
        formData.append("save_payment", true);

        $.ajax({
            type: "POST",
            url: "action/code-payment.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                try {
                    var res = jQuery.parseJSON(response);

                    if (res.status == 422) {
                        $('#errorMessage').removeClass('d-none').text(res.message);
                    } else if (res.status == 200) {
                        Swal.fire({
                            text: 'Student Payment Successfully',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    } else if (res.status == 500) {
                        alert(res.message);
                    } else if (res.status == 322) {
                        $('#errorMessage').removeClass('d-none').text(res.message);
                    }
                } catch (error) {
                    console.error("Error parsing JSON response:", error);
                    // Handle the error, display a message, or log it as needed
                }
            },
            error: function (xhr, status, error) {
                console.error("Ajax request failed:", error);
                // Handle the error, display a message, or log it as needed
            }
        });
    });
</script>

<!-- Bottom Section-->
<?php include 'include/botSection.php'; ?>

