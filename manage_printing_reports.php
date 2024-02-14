<?php
session_start();
include 'connect.php';
include 'include/topSection.php';
	
	$enrollment_id = $_GET['enrollment_id'];

	//echo $enrollment_id;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print and Save as PDF</title>
    
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">


    
    <style>
        @media print {
            button {
                display: none;
            }
        }
        /* Style the hr tag */
        .hr {
            color: black !important;
            border: 2px solid black; /* Set the border style */
            margin: 10px 0; /* Add margin for better spacing */
        }
        input{
        	text-transform: uppercase;
        	font-weight: bold;
        }
    </style>
</head>
<body>

    <div id="content">
        <h1>Hello, this is a printable page</h1>
        <p>This is some content that you might want to print.</p>

        <div class="card">
            
            <div class="card-body">
                
                <h5 class="fw-bolder">
                    PERSONAL INFORMATION: <span class="fst-italic" style="font-size: 15px;">(Fill-up the needed information)</span>
                </h5>

                <?php
					$query = "SELECT t1.*, t2.student_id, t2.lrn, t2.fname, t2.mname, t2.lname, t2.extension, t2.gender, t2.birthdate, CURDATE(), TIMESTAMPDIFF(YEAR, t2.birthdate, CURDATE()) as age, t2.prevschool, t2.address, t2.pbirth, t2.cnumber, t2.schoolYear, t2.f_fname, t2.f_mname, t2.f_lname, t2.f_extension, t2.f_occupation, t2.m_fname, t2.m_mname, t2.m_lname, t2.m_extension, t2.m_occupation, t2.status, t3.*, t4.*, t5.*
				              FROM tbl_enrollment AS t1
				              INNER JOIN tbl_student AS t2 ON t2.student_id = t1.student_id
				              INNER JOIN tbl_student_subject AS t3 ON t3.student_id = t1.student_id
				              INNER JOIN tbl_offered_subject AS t4 ON t4.offered_subject_id = t3.offered_subject_id
				              INNER JOIN tbl_subject AS t5 ON t5.subject_id = t4.subject_id
				              WHERE t1.enrollment_id = $enrollment_id";
				    $result = mysqli_query($connect, $query);
					    if (mysqli_num_rows($result) > 0 ){
					        $row = mysqli_fetch_array($result)
					            //$middle_name = substr($row["mname"], 0, 1);
					            //$f_middle_name = substr($row["f_mname"], 0, 1);
					            //$m_middle_name = substr($row["m_mname"], 0, 1);
				?>

                <div class="enrollmentForm" style="padding: 23px; margin-left: 70px;">

                    <div class="row mb-3">
                        <div class="input-group mb-3">
                            <span class="fw-bolder mt-3 me-1">Name:</span>
                            <div class="col-md-2">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["fname"] ?>" style="border: none;" readonly>
                                <center><label class="form-label mt-1 fst-italic" style="font-size: 14px;">(First Name)</label></center>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["mname"] ?>" style="border: none;" readonly>
                                <center><label class="form-label mt-1 fst-italic" style="font-size: 14px;">(Middle Name)</label></center>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["lname"] ?>" style="border: none;" readonly>
                                <center><label class="form-label mt-1 fst-italic" style="font-size: 14px;">(Last Name)</label></center>
                            </div>
                            <span class="fw-bolder mt-3 me-1" style="margin-left: 85px;">Age:</span>
                            <div class="col-md-1">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["age"] ?>" style="border: none;" readonly>
                            </div>
                            <span class="fw-bolder mt-3 me-1" style="margin-left: 80px;">Sex:</span>
                            <div class="col-md-1">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["gender"] ?>" style="border: none;" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="input-group mb-3">
                            <span class="fw-bolder mt-3 me-1">Address:</span>
                            <div class="col-md-10">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["address"] ?>" style="border: none; width: 990px;" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="input-group mb-3">
                            <span class="fw-bolder mt-3 me-1">Place of Birth:</span>
                            <div class="col-md-6">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["pbirth"] ?>" style="border: none;" readonly>
                            </div>
                            <span class="fw-bolder mt-3 me-1" style="margin-left: 80px;">Date of Birth:</span>
                            <div class="col-md-2">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["birthdate"] ?>" style="border: none;" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3" style="margin-top: 30px;">
                        <div class="input-group mb-3">
                            <span class="fw-bolder mt-3 me-1">Name of Father:</span>
                            <div class="col-md-2">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["f_fname"] ?> <?php echo $row["f_extension"] ?>" style="border: none;" readonly>
                                <center><label class="form-label mt-1 fst-italic" style="font-size: 14px;">(First Name)</label></center>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["f_mname"] ?>" style="border: none;" readonly>
                                <center><label class="form-label mt-1 fst-italic" style="font-size: 14px;">(Middle Name)</label></center>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["f_lname"] ?>" style="border: none;" readonly>
                                <center><label class="form-label mt-1 fst-italic" style="font-size: 14px;">(Last Name)</label></center>
                            </div>
                            <span class="fw-bolder mt-3 me-1" style="margin-left: 75px;">Occupation:</span>
                            <div class="col-md-2">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["f_occupation"] ?>" style="border: none;" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="input-group mb-3">
                            <span class="fw-bolder mt-3 me-1">Name of Mother:</span>
                            <div class="col-md-2">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["m_fname"] ?> <?php echo $row["m_extension"] ?>" style="border: none;" readonly>
                                <center><label class="form-label mt-1 fst-italic" style="font-size: 14px;">(Maiden Name)</label></center>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["m_mname"] ?>" style="border: none;" readonly>
                                <center><label class="form-label mt-1 fst-italic" style="font-size: 14px;">(Middle Name)</label></center>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["m_lname"] ?>" style="border: none;" readonly>
                                <center><label class="form-label mt-1 fst-italic" style="font-size: 14px;">(Last Name)</label></center>
                            </div>
                            <span class="fw-bolder mt-3 me-1" style="margin-left: 65px;">Occupation:</span>
                            <div class="col-md-2">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["m_occupation"] ?>" style="border: none;" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3" style="margin-top: 30px;">
                        <div class="input-group mb-3">
                            <span class="fw-bolder mt-3 me-1">School last Attended:</span>
                            <div class="col-md-6">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["prevschool"] ?>" style="border: none;" readonly>
                            </div>
                            <span class="fw-bolder mt-3 me-1" style="margin-left: 95px;">SY:</span>
                            <div class="col-md-2">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["schoolYear"] ?>" style="border: none;" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 30px;">
                        <div class="input-group mb-3">
                            <span class="fw-bolder mt-3 me-1">LRN:</span>
                            <div class="col-md-3">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["lrn"] ?>" style="border: none;" readonly>
                            </div>
                            <span class="fw-bolder mt-3 me-1" style="margin-left: 40px;">LRN:</span>
                            <div class="col-md-2">
                                <input type="text" class="form-control text-center border-bottom border-2" value="88.80" style="border: none;" readonly>
                            </div>
                            <span class="fw-bolder mt-3 me-1" style="margin-left: 40px;">Contact Number:</span>
                            <div class="col-md-2">
                                <input type="text" class="form-control text-center border-bottom border-2" value="<?php echo $row["cnumber"] ?>" style="border: none;" readonly>
                            </div>
                        </div>
                    </div>

                </div>
				<?php
						}
							
				?>
                <hr class="hr">

            </div>

        </div>
    </div>

    <button onclick="printPage()">Print</button>
    <button onclick="saveAsPDF()">Save as PDF</button>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <script>
        function printPage() {
            window.print();
        }

        function saveAsPDF() {
            var element = document.body; // Choose the element that you want to convert to PDF
            html2pdf(element);
        }
    </script>

</body>
</html>