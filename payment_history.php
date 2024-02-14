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
                        <h1 class="h3 mb-0 text-gray-800">PAYMENT HISTORY</h1>
                    </div>

                    <!-- Content -->
                    <?php include 'include/form/form_payments.php'; ?>


                    <div class="container mt-4 mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex mb-2">
                                    <a href="payment_history_report.php" target="_blank" class="btn btn-success"><i class="fal fa-print"></i>&nbsp;Print</a>
                                </div>
                                <div class="card shadow">
                                    <div class="card-header">
                                        <h4><i class="fas fa-award"></i> Payment History
                                        </h4>
                                    </div>
                                    <div class="card-body table-responsive">

                                        <table id="myTable" class="display table table-bordered table-hover">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th class="text-center"> LRN </th>
                                                    <th class="text-center"> Student Name </th>
                                                    <th class="text-center"> Grade Level & Section/ STRAND </th>
                                                    <th class="text-center"> School Year </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            include 'connect.php';
                                            $sql = "SELECT a.*, b.name, CONCAT(d.fname,' ',d.mname,' ',d.lname,' ',d.extension) as fullname, d.lrn, e.grade_level_section, b.name as feename
            FROM `tbl_payments` as a 
            LEFT JOIN tbl_fee as b ON a.fee_id = b.id
            LEFT JOIN tbl_enrollment as c ON a.enrollment_id = c.enrollment_id
            LEFT JOIN tbl_student as d ON c.student_id = d.student_id
            LEFT JOIN tbl_grade_level as e ON c.grade_level_id = e.grade_level_id";
                                            $result = mysqli_query($connect, $sql);
                                            while ($row = mysqli_fetch_array($result)) {
                                                $sy = $row['schoolyear'];
                                                $enrollment_id = $row['enrollment_id'];

                                                // Fetch all payments for the current student
                                                $student_payments = array();
                                                $payment_sql = "SELECT or_number, payment, datetime FROM tbl_payments WHERE enrollment_id = $enrollment_id";
                                                $payment_result = mysqli_query($connect, $payment_sql);
                                                while ($payment_row = mysqli_fetch_array($payment_result)) {
                                                    $student_payments[] = array(
                                                        "or_number" => $payment_row['or_number'],
                                                        "payment" => $payment_row['payment'],
                                                        "date" => $payment_row['datetime']
                                                    );
                                                }
                                                $json_student_payments = json_encode($student_payments);
                                                ?>
                                                <tr data-child='<?php echo $json_student_payments; ?>'>
                                                    <td class="text-center">
                                                        <?php echo $row["lrn"]; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row["fullname"]; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row["grade_level_section"]; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row["schoolyear"]; ?>
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
        $(document).ready(function() {
            var parentTable = $('#myTable').DataTable({
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false
                }]
            });

            $('#myTable tbody').on('click', 'tr', function() {
                var tr = $(this).closest('tr');
                var row = parentTable.row(tr);

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    var childData = JSON.parse(tr.attr('data-child').replace(/'/g, '"'));
                    var childTable = createChildTable(childData);
                    row.child(childTable).show();
                    tr.addClass('shown');
                }
            });

            function createChildTable(data) {
                var childTable = $('<table>').addClass('display').append('<thead><tr><th>OR Number</th><th>Payment</th><th>Date</th></tr></thead><tbody>');

                for (var i = 0; i < data.length; i++) {
                    var row = $('<tr>');
                    row.append('<td>' + data[i].or_number + '</td>');
                    row.append('<td>' + data[i].payment + '</td>');
                    row.append('<td>' + data[i].date + '</td>');
                    childTable.append(row);
                }

                return childTable;
            }
        });
    </script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#paymentModal').hide()
        $('#myTable').on('click', '.addpaymentBtn', function() {
            gradelevel = $(this).data('gradelevel')
            schoolyear = $(this).data('schoolyear')
            enrollmentid =  $(this).data('enrollmentid')
            $('#enrollment_id').val(enrollmentid)
            $('#schoolyear').val(schoolyear)
            
            $.ajax({
                type: "GET",
                url: 'action/code-payment.php',
                data: {gradelevel: gradelevel,schoolyear:schoolyear,enrollmentid:enrollmentid},
                success: function(data){
                    var response = JSON.parse(data);
                    // Clear the existing table content before populating with new data
                    $('#paymentTbody').empty();                   
                    console.log(response)
                  // Assuming response.data is an array of objects
                    $.each(response.data, function(index, value) {
                      var bal =  value.collect-value.totalpayment
                      
                      if (bal>0){

                        // Create a new table row for each object
                        var tableRow = $('<tr>');

                        // Create table data cells for specific properties and append them to the row
                        var nameData = $('<td>').text(value.name);
                        var collectData = $('<td>').text(value.collect);
                        var balanceData = $('<td>').text(value.collect-value.totalpayment);

                        // Create an input tag in a table cell
                        var inputCell = $('<td>');

                        var input2Hidden = $('<input>').attr('name','feeid[]').attr('hidden',true).val(value.feeID);

                       
                        var inputTag = $('<input>')
                                    .attr('type', 'number')
                                    .attr('value', '0') // Set the initial value to 0
                                    .attr('min', '0')
                                    .attr('max', bal)
                                    .attr('required', true)
                                    .attr('name', 'payment[]')
                                    .addClass('form-control paymentInput')
                                    .on('blur', function () {
                                        var inputValue = parseFloat($(this).val());
                                        if (isNaN(inputValue)) {
                                            // If the input is not a valid number, set it to 0
                                            $(this).val(0);
                                        } else if (inputValue > bal) {
                                            // If the input value is greater than bal, set it to balanceData
                                            $(this).val(bal);
                                        }
                                        // You can add additional handling or validation as needed
                                    });

                                // Add attributes as needed
                                                    }

                        inputCell.append(inputTag);

                        tableRow.append(nameData);
                        tableRow.append(collectData);
                        tableRow.append(balanceData);
                        tableRow.append(inputCell); // Append the cell with the input tag
                        tableRow.append(input2Hidden); // Append the cell with the input tag

                        // Append the row to the table body
                        $('#paymentTbody').append(tableRow);
                    });



                }
            })


            $('#paymentModal').slideDown("slow");
        });
        $('#closeBtn').click(function() {
            $('#paymentModal').slideUp("slow");
        });

    
    });
</script>
<script type="text/javascript">
    $(document).on('click', '#subBtn', function (e) {
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

