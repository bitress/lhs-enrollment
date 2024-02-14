<?php 
session_start();
include 'connect.php';
include 'include/topSection.php';
	
	$enrollment_id = $_GET['enrollment_id'];

	//echo $enrollment_id;

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
        //while ($row = mysqli_fetch_array($result)) {
            //$middle_name = substr($row["mname"], 0, 1);
            //$f_middle_name = substr($row["f_mname"], 0, 1);
            //$m_middle_name = substr($row["m_mname"], 0, 1);

?>

    <div class="" style="">
        <img src="img/lhs-logo.png" class="top-left-box1">
    </div>

    <div class="" style="">
        <img src="img/ispsc.png" class="top-left-box2">
    </div>

    <center>
        <div style="">
            <h5 class="text-capitalize">ilocos sur polytechnic state college</h5>
            <h6 class="text-capitalize">laboratory hih school</h6>
            <span class="text-capitalize">main campus, sta. maria 2705, ilocos sur</span>
        </div>
    </center>

    <div class="top-right-box" style="">
        2" x 2" ID Picture
    </div>

    <h2 class="text-center text-uppercase font-weight-bolder mb-2 mt-5">enrollment form</h2>

    <div class="form-group row" style="margin-top: 120px;">
        <div class="col-sm-4">
            <input type="text" id="" class="form-control mt-2" value="School Copy/Student Copy Number:" style="font-style: italic; border: none;">
        </div>
        <div class="col-sm-2">
            <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: -90px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; width: 500px;">
        </div>

        <div class="col-sm-2">
            <input type="text" id="" class="form-control mt-2" value="Student Type:" style="font-style: italic; margin-left: 120px; border: none;">
        </div>
        <div class="col-sm-1">
            <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: 50px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; width: 100px;">
        </div>
        <div class="col-sm-1">
            <input type="text" id="" class="form-control mt-2" value="Old" style="font-style: italic; margin-left: 60px; border: none;">
        </div>
        <div class="col-sm-1">
            <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: 10px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; width: 100px;">
        </div>
        <div class="col-sm-1">
            <input type="text" id="" class="form-control mt-2" value="New" style="font-style: italic; margin-left: 10px; border: none;">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-3">
            <input type="text" id="" class="form-control mt-2" value="Date of Registration:" style="font-style: italic; border: none;">
        </div>
        <div class="col-sm-1">
            <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: -110px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; width: 300px;">
        </div>

        <div class="col-sm-2">
            <input type="text" id="" class="form-control mt-2" value="Grade Level:" style="font-style: italic; border: none;">
        </div>
        <div class="col-sm-1">
            <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: -80px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; width: 200px;">
        </div>

        <div class="col-sm-2">
            <input type="text" id="" class="form-control mt-2" value="Semester:" style="font-style: italic; border: none;">
        </div>
        <div class="col-sm-1">
            <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: -80px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; width: 200px;">
        </div>

        <div class="col-sm-1">
            <input type="text" id="" class="form-control mt-2" value="S.Y:" style="font-style: italic; border: none;">
        </div>
        <div class="col-sm-1">
            <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: -40px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; width: 100px;">
        </div>
    </div>

    <hr id="border-line" style="margin-top: 50px; margin-bottom: 20px;">

    <h5 class="text-uppercase">
        required forms: <span style="font-style: italic; text-transform: capitalize; font-size: 14px;">(check if available)</span>
    </h5>

    <div class="col-sm-2 ml-5">
        <span  style="font-style: italic; margin-left: 50px;">Photocopy of:</span>
    </div>
    <div class="form-group row">
        <div class="col-sm-1 ml-5">
            <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: 75px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
            <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: 75px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
        </div>
        <div class="col-sm-3">
            <input type="text" id="" class="form-control mt-2" value="Form 137-E" style="margin-left: 70px; border: none;">
            <input type="text" id="" class="form-control mt-1" value="PSA(NSO) Birth Certificate" style="margin-left: 70px; border: none;">
        </div>

        <div class="col-sm-1 ml-5">
            <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: 110px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
            <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: 110px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
        </div>
        <div class="col-sm-3">
            <input type="text" id="" class="form-control mt-2" value="Form 138(Report Card)" style="margin-left: 100px; border: none;">
            <input type="text" id="" class="form-control mt-1" value="Certificate of Good Moral Character" style="margin-left: 100px; border: none;">
        </div>
    </div>

    <div class="col-sm-2 ml-5">
        <span  style="font-style: italic; margin-left: 50px;">Others:</span>
    </div>
    <div class="form-group row">
        <div class="col-sm-1 ml-5">
            <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: 75px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
            <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: 75px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
        </div>
        <div class="col-sm-3">
            <input type="text" id="" class="form-control mt-2" value='Two 2" x 2" ID Picture (white Background)' style="margin-left: 70px; border: none;">
            <input type="text" id="" class="form-control mt-1" value="1 Long Brown Envelope" style="margin-left: 70px; border: none;">
        </div>

        <div class="col-sm-1 ml-5">
            <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: 110px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
        </div>
        <div class="col-sm-3">
            <input type="text" id="" class="form-control mt-2" value="Clearance (Old Students)" style=" margin-left: 100px; border: none;">
        </div>
    </div>


    <hr id="border-line" style="margin-top: 50px; margin-bottom: 20px;">

    <h5 class="text-uppercase">
        personal information: <span style="font-style: italic; text-transform: capitalize; font-size: 14px;">(fill-up the needed information)</span>
    </h5>
    
    <div class="form-group row">
        <span class="mt-2 col-sm-1 col-form-label" id="form-label">name:</span>
        <div class="col-sm-2">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['fname']; ?>">
            <center><span class="form-text" id="form-text">(First Name)</span></center>
        </div>
        <div class="col-sm-2">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['mname']; ?>">
            <center><span class="form-text" id="form-text">(Middle Name)</span></center>
        </div>
        <div class="col-sm-2">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['lname']; ?>">
            <center><span class="form-text" id="form-text">(Last Name)</span></center>
        </div>

        <span class="mt-2 col-sm-1 col-form-label" id="form-label">age:</span>
        <div class="col-sm">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['age']; ?>">
        </div>

        <span class="mt-2 col-sm-1 col-form-label" id="form-label">sex:</span>
        <div class="col-sm">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['gender']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <span class="mt-2 col-sm-1 col-form-label" id="form-label">address:</span>
        <div class="col-sm-6">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['address']; ?>">
        </div>
        <span class="mt-2 col-sm-2 col-form-label" id="form-label">date of birth:</span>
        <div class="col-sm">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['birthdate']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <span class="mt-2 col-sm-2 col-form-label" id="form-label">place of birth:</span>
        <div class="col-sm">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['pbirth']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <span class="mt-2 col-sm-2 col-form-label" id="form-label">name of father:</span>
        <div class="col-sm-2">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['f_fname']; ?> <?php echo $row['f_extension']; ?>">
            <center><span class="form-text" id="form-text">(First Name)</span></center>
        </div>
        <div class="col-sm-2">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['f_mname']; ?>">
            <center><span class="form-text" id="form-text">(Middle Name)</span></center>
        </div>
        <div class="col-sm-2">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['f_lname']; ?>">
            <center><span class="form-text" id="form-text">(Last Name)</span></center>
        </div>

        <span class="mt-2 col-sm-1 col-form-label" id="form-label">occupation:</span>
        <div class="col-sm">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['f_occupation']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <span class="mt-2 col-sm-2 col-form-label" id="form-label">name:</span>
        <div class="col-sm-2">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['m_fname']; ?> <?php echo $row['m_extension']; ?>">
            <center><span class="form-text" id="form-text">(First Name)</span></center>
        </div>
        <div class="col-sm-2">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['m_mname']; ?>">
            <center><span class="form-text" id="form-text">(Middle Name)</span></center>
        </div>
        <div class="col-sm-2">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['m_lname']; ?>">
            <center><span class="form-text" id="form-text">(Last Name)</span></center>
        </div>

        <span class="mt-2 col-sm-1 col-form-label" id="form-label">occupation:</span>
        <div class="col-sm">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['m_occupation']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <span class="mt-2 col-sm-2 col-form-label" id="form-label">school last attended:</span>
        <div class="col-sm-6">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['prevschool']; ?>">
        </div>
        <span class="mt-2 col-sm-1 col-form-label" id="form-label">S.Y:</span>
        <div class="col-sm">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['schoolYear']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <span class="mt-2 col-sm-1 col-form-label" id="form-label">lrn:</span>
        <div class="col-sm">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['lrn']; ?>">
        </div>
        <span class="mt-2 col-sm-2 col-form-label" id="form-label">general average:</span>
        <div class="col-sm">
            <input type="text" id="inputs" class="form-control" value="88.80">
        </div>
        <span class="mt-2 col-sm-2 col-form-label" id="form-label">contact number:</span>
        <div class="col-sm">
            <input type="text" id="inputs" class="form-control" value="<?php echo $row['cnumber']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <span class="mt-2 col-sm-2 col-form-label" id="form-label">signature of studets:</span>
        <div class="col-sm-4">
            <input type="text" id="inputs" class="form-control" value="">
        </div>
    </div>

    <hr id="border-line" style="margin-top: 60px; margin-bottom: 50px;">

    <span style="font-style: italic; text-transform: capitalize; font-size: 14px;">.fill-up the needed information.</span>

        <div class="form-group row">
            <div class="col-sm-1 ml-5">
                <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: 35px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
                <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: 75px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
                <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: 75px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
                <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: 75px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
            </div>
            <div class="col-sm-3">
                <input type="text" id="" class="form-control mt-2 font-weight-bold" value="Academic Track" style="margin-left: 40px; border: none;">
                <input type="text" id="" class="form-control mt-1" value="STEM" style="margin-left: 70px; border: none;">
                <input type="text" id="" class="form-control mt-1" value="GAS" style="margin-left: 70px; border: none;">
                <input type="text" id="" class="form-control mt-1" value="HUMSS" style="margin-left: 70px; border: none;">
            </div>

            <div class="col-sm-1 ml-5">
                <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: 70px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
                <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: 110px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
                <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: 110px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
                <input type="text" id="" class="form-control" value="" style="font-style: italic; margin-left: 110px; border: none; border-bottom: 1px solid #000; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
            </div>
            <div class="col-sm-5">
                <input type="text" id="" class="form-control mt-2 font-weight-bold" value="Technical-Vocational and Livelihood Track" style="margin-left: 60px; border: none;">
                <input type="text" id="" class="form-control mt-1" value="Home Economics" style="margin-left: 100px; border: none;">
                <input type="text" id="" class="form-control mt-1" value="Agri-fishery Arts" style="margin-left: 100px; border: none;">
                <input type="text" id="" class="form-control mt-1" value="Information & Communication Technology" style="margin-left: 100px; border: none;">
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-uppercase text-center" style="width: 15%;"> subject code </th>
                    <th class="text-uppercase text-center" style="width: 35%;"> descriptive title </th>
                    <th class="text-uppercase text-center" style="width: 15%;"> no. of hours/ semester </th>
                    <th class="text-uppercase text-center" style="width: 15%;"> no. of hours/ week </th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT t1.*, t2.*, t3.*, t4.*, t5.*
                    FROM tbl_enrollment AS t1
                    INNER JOIN tbl_student AS t2 ON t2.student_id = t1.student_id
                    INNER JOIN tbl_student_subject AS t3 ON t3.student_id = t1.student_id
                    INNER JOIN tbl_offered_subject AS t4 ON t4.offered_subject_id = t3.offered_subject_id
                    INNER JOIN tbl_subject AS t5 ON t5.subject_id = t4.subject_id
                    WHERE t1.enrollment_id = $enrollment_id";
                $result = mysqli_query($connect, $query);
                    if (mysqli_num_rows($result) > 0 ){
                        //$row = mysqli_fetch_array($result)
                        while ($row = mysqli_fetch_array($result)) {
                            $hrsSemCount[] = $row['hrsSem'];
                            $hrsWeekCount[] = $row['hrsWeek'];

            ?>
                <tr class="text-capitalize text-center">
                    <td><?php echo $row['subject_code']; ?></td>
                    <td><?php echo $row['subject_name']; ?></td>
                    <td><?php echo $row['hrsSem']; ?></td>
                    <td><?php echo $row['hrsWeek']; ?></td>
                </tr>
                   
            <?php 
                    }
                        } 

                // Calculate the sum
                (int)$hrsSemSum = array_sum($hrsSemCount);
                (int)$hrsWeekSum = array_sum($hrsWeekCount);

            ?>
                <td class="text-center font-weight-bold text-uppercase" colspan="2">Total</td>
                <td class="text-center font-weight-bold"><?php echo $hrsSemSum; ?></td>
                <td class="text-center font-weight-bold"><?php echo $hrsWeekSum; ?></td>
            </tbody>
        </table>


    <button onclick="printPage()">Print</button>
    <button onclick="saveAsPDF()">Save as PDF</button>
    <button><a href="manage_enrollment.php" style="text-decoration: none; color: black;">back</a></button>

    <script>
        function printPage() {
            window.print();
        }

        function saveAsPDF() {
            var element = document.body; // Choose the element that you want to convert to PDF
            var filename = document.getElementById('filename').value || 'document'; // Default filename is 'document' if not provided
            var options = { filename: filename, margin: 10, jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' } };
            
            html2pdf(element, options);
        }
    </script>


<?php
		}
?>