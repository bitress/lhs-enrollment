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
                                                    <th class="text-center"> Status </th>
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


                                                        $tuitionFeeQuery = "SELECT 
    tbl_student.lrn,
    tbl_enrollment.enrollment_id,
    tbl_student.student_id,
    tbl_student.fname,
    tbl_student.mname,
    tbl_student.lname,
    tbl_student.extension,
    t4.sy,
    tbl_grade_level.grade_level,
    GROUP_CONCAT(tbl_subject.subject_name SEPARATOR ', ') AS subjects,
    COUNT(tbl_subject.subject_id) AS num_subjects,
    SUM(tbl_offered_subject.units) AS total_units
FROM 
    tbl_student_subject 
INNER JOIN 
    tbl_offered_subject ON tbl_offered_subject.offered_subject_id = tbl_student_subject.offered_subject_id 
INNER JOIN 
    tbl_subject ON tbl_subject.subject_id = tbl_offered_subject.subject_id 
INNER JOIN 
    tbl_enrollment ON tbl_enrollment.enrollment_id = tbl_student_subject.enrollment_id 
INNER JOIN 
    tbl_student ON tbl_student.student_id = tbl_student_subject.student_id 
INNER JOIN 
    tbl_grade_level ON tbl_grade_level.grade_level_id = tbl_enrollment.grade_level_id 
INNER JOIN 
    tbl_sy AS t4 ON t4.sy_id = tbl_enrollment.sy_id 
WHERE
        tbl_enrollment.enrollment_id = '$enrollment_id'
    GROUP BY 
        tbl_student.student_id;";

                                                        $tuitionFeeQuery_run = mysqli_query($connect, $tuitionFeeQuery);

                                                        if ($tuitionFeeQuery_run && mysqli_num_rows($tuitionFeeQuery_run) > 0) {
                                                            $r = mysqli_fetch_assoc($tuitionFeeQuery_run);
                                                            $tuitionFeePayment = $r['total_units'] * 150;
                                                        }




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
//                                                        $payment = $payment > 1 ? $payment : 0;


                                                        $totalCollection = $tuitionFeePayment + $collection;

                                                        $totalbal = ($totalCollection) - $payment;

                                                        if ($payment == 0) {
                                                            $status = '<span class="badge badge-warning">Not Paid</span>';
                                                        } else if ($payment >= $totalCollection) {
                                                            $status = '<span class="badge badge-success">Paid</span>';
                                                        } else if ($payment >0) {
                                                            $status = '<span class="badge badge-info">Pending</span>';
                                                        } else {
                                                            $status = "idk";
                                                        }
//
//
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
                                                        P<?php echo number_format($totalbal, 2) ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $status ?>
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


                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="studentTuitionBalance">Tuition Fee</label>
                                <input type="text" readonly id="studentTuitionBalance" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="studentMiscellaneousBalance">Miscellaneous Fee</label>
                                <input type="text" readonly id="studentMiscellaneousBalance" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="studentTotalBalance">Total Fee</label>
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

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="whatToPay">What to Pay?</label>
                                <select name="whatToPay"  id="whatToPay" class="form-control">
                                    <option value="Tuition Fee">Tuition Fee</option>
                                    <option value="Miscellaneous Fee">Miscellaneous Fee</option>
                                </select>
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
                    $('#studentTuitionBalance').val(response.tuitionFeeBalance.toFixed(2));
                    $('#studentMiscellaneousBalance').val(response.miscellaneousFeeBalance.toFixed(2));

                    $("#studentPayment").attr({
                        "max" : response.totalBalance,
                        "min" : 100
                    });



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

        var paymentValue = parseInt($('#studentPayment').val());
        var maxPayment = parseInt($('#studentPayment').attr('max'));

        if (paymentValue > maxPayment){
            alert("Payment Exceeded");
            return false;
        }

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

