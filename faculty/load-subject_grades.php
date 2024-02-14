<?php
    include 'connect.php';
    $student_id = $_POST['student_id'];
    $int = (int)$student_id;

    $query = "SELECT t1.*, t4.subject_name, t7.*, t3.offered_subject_id, t6.grade_level_section, t6.grade_level, t5.sy
        FROM tbl_grade AS t1
        INNER JOIN tbl_enrollment AS t2 ON t2.enrollment_id = t1.enrollment_id
        INNER JOIN tbl_offered_subject AS t3 ON t3.offered_subject_id = t1.offered_subject_id
        INNER JOIN tbl_subject AS t4 ON t4.subject_id = t3.subject_id
        INNER JOIN tbl_sy AS t5 ON t5.sy_id = t2.sy_id
        INNER JOIN tbl_grade_level AS t6 ON t6.grade_level_id = t3.grade_level_id
        INNER JOIN tbl_student AS t7 ON t7.student_id = t2.student_id
        WHERE t2.student_id = $int";
                
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) > 0 ){
    $row = mysqli_fetch_array($result)
    //$mname = substr($row["mname"], 0, 1);
?>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="text-uppercase fw-bolder">Student Name</label>
        <input type="text" name="" class="form-control text-capitalize" value="<?php echo $row['fname']; ?> <?php echo substr($row["mname"], 0, 1); ?>. <?php echo $row['lname']; ?> <?php echo $row['extension']; ?>" disabled>
    </div>
     <div class="col-md-4 mb-3">
        <label class="text-uppercase fw-bolder">Grade Level</label>
        <input type="text" name="" class="form-control text-capitalize" value="<?php echo $row['grade_level_section']; ?>" disabled>
    </div>
    <div class="col mb-4">
        <label class="text-uppercase fw-bolder">School Year</label>
        <input type="text" name="" class="form-control text-capitalize" value="<?php echo $row['sy']; ?>" disabled>
    </div>
</div>
<?php
    }else {
        echo "
            <div class='alert alert-info text-uppercase' role='alert'>
              no record yet!
            </div>
        ";
    }
?>

<!-- Grades -->
<table class="table table-bordered">
    <thead class="table-info" style="font-size: 13px;">
        <tr class="text-center text-capitalize">
            <th> Subject </th>
            <th style="width: 100px;"> 1<sup>st</sup> Quarter </th>
            <th style="width: 100px;"> 2<sup>nd</sup> Quarter </th>
            <th style="width: 100px;"> 3<sup>rd</sup> Quarter </th>
            <th style="width: 100px;"> 4<sup>th</sup> Quarter </th>
            <th style="width: 15%;"> Remarks </th>
        </tr>
    </thead>
    <?php
        include 'connect.php';
        $student_id = $_POST['student_id'];
        $int = (int)$student_id;

        $query = "SELECT t1.*, t4.subject_name, CONCAT(t7.fname, ' ', LEFT(t7.mname, 1), '. ', t7.lname, ' ', t7.extension) AS 'student', t7.gender, t6.student_subject_id, t3.offered_subject_id, t5.sy, t5.firstQ_status, t5.secondQ_status, t5.thirdQ_status, t5.fourthQ_status
            FROM tbl_grade AS t1
            INNER JOIN tbl_enrollment AS t2 ON t2.enrollment_id = t1.enrollment_id
            INNER JOIN tbl_offered_subject AS t3 ON t3.offered_subject_id = t1.offered_subject_id
            INNER JOIN tbl_subject AS t4 ON t4.subject_id = t3.subject_id
            INNER JOIN tbl_sy AS t5 ON t5.sy_id = t2.sy_id
            INNER JOIN tbl_student_subject AS t6 ON t6.student_subject_id = t1.student_subject_id
            INNER JOIN tbl_student AS t7 ON t7.student_id = t2.student_id
            WHERE t2.student_id = $int
            ORDER BY t7.gender DESC, t7.lname ASC, t4.subject_id";
           
            $firstQ_total = 0;
            $secondQ_total = 0;
            $thirdQ_total = 0;
            $fourthQ_total = 0;
            $final_total = 0;
            $x = 0;
        $result = mysqli_query($connect, $query);
            $up = 0;
    ?>
        <tr style="display: none;">
            <td colspan="8">
                <input type="text" name="student_id" value="<?php echo''.$int.''; ?>">
            </td>
        </tr>
    <?php
        while ($row = mysqli_fetch_array($result)) {
            $firstQ = (int)$row['firstQ'];
            $secondQ = (int)$row['secondQ'];
            $thirdQ = (int)$row['thirdQ'];
            $fourthQ = (int)$row['fourthQ'];

            $finalGrade = ($firstQ + $secondQ + $thirdQ + $fourthQ) / 4;

            $firstQ_total = $firstQ_total + $firstQ;
            $secondQ_total = $secondQ_total + $secondQ;
            $thirdQ_total = $thirdQ_total + $thirdQ;
            $fourthQ_total = $fourthQ_total + $fourthQ;
            $final_total = $final_total + $finalGrade;
            $x++;

            $up++;

    ?>
    <tbody>
        <tr class="text-uppercase">
             <td style="display: none;">
                <input type="hidden" id="grade_id" name="grade_id[]" value="<?php echo $row["grade_id"] ?>"> 
            </td>
            <td class="text-center"> 
                <?php echo $row["subject_name"] ?> 
            </td>
            <td> 
                <?php
                    if ($row["firstQ_status"] == 1) {
                ?>
                    <input type="number" name="firstQ[]" value="<?php echo $row["firstQ"] ?>" class="form-control" id="firstQ<?php echo''.$up.''?>" oninput="input_grade<?php echo''.$up.''?>()"  min="70" max="99">
                <?php
                    } else {
                ?>
                    <input type="number" name="firstQ[]" value="<?php echo $row["firstQ"] ?>" class="form-control" id="firstQ<?php echo''.$up.''?>" oninput="input_grade<?php echo''.$up.''?>()"  min="70" max="99" disabled>
                <?php 
                     }
                ?>
            </td>
            <td>
                <?php
                    if ($row["secondQ_status"] == 1) {
                ?>
                    <input type="number" name="secondQ[]" value="<?php echo $row["secondQ"] ?>" class="form-control" id="secondQ<?php echo''.$up.''?>" oninput="input_grade<?php echo''.$up.''?>()" min="70" max="99"> 
                <?php
                    } else {
                ?>
                    <input type="number" name="secondQ[]" value="<?php echo $row["secondQ"] ?>" class="form-control" id="secondQ<?php echo''.$up.''?>" oninput="input_grade<?php echo''.$up.''?>()" min="70" max="99" disabled> 
                <?php 
                     }
                ?> 
            </td>
            <td> 
                <?php
                    if ($row["thirdQ_status"] == 1) {
                ?>
                    <input type="number" name="thirdQ[]" value="<?php echo $row["thirdQ"] ?>" class="form-control" id="thirdQ<?php echo''.$up.''?>" oninput="input_grade<?php echo''.$up.''?>()"  min="70" max="99">
                <?php
                    } else {
                ?>
                    <input type="number" name="thirdQ[]" value="<?php echo $row["thirdQ"] ?>" class="form-control" id="thirdQ<?php echo''.$up.''?>" oninput="input_grade<?php echo''.$up.''?>()"  min="70" max="99" disabled>
                <?php 
                     }
                ?>
            </td>
            <td>
                <?php
                    if ($row["fourthQ_status"] == 1) {
                ?>
                    <input type="number" name="fourthQ[]" value="<?php echo $row["fourthQ"] ?>" class="form-control" id="fourthQ<?php echo''.$up.''?>" oninput="input_grade<?php echo''.$up.''?>()" min="70" max="99"> 
                <?php
                    } else {
                ?>
                    <input type="number" name="fourthQ[]" value="<?php echo $row["fourthQ"] ?>" class="form-control" id="fourthQ<?php echo''.$up.''?>" oninput="input_grade<?php echo''.$up.''?>()" min="70" max="99" disabled> 
                <?php 
                     }
                ?>
            </td>
            <td>
                <input type="text" name="remarks[]" id="remarks<?php echo''.$up.''?>" value="<?php echo $row["remarks"] ?>" class="form-control" oninput="input_grade<?php echo''.$up.''?>()" readonly> 
            </td>
        </tr>
        <script>
        function input_grade<?php echo''.$up.''?>(){

            var firstQ = 0;
            var secondQ = 0;
            var thirdQ = 0;
            var fourthQ = 0;

            var firstQ = $("#firstQ<?php echo''.$up.''?>").val();
            var secondQ = $("#secondQ<?php echo''.$up.''?>").val();
            var thirdQ = $("#thirdQ<?php echo''.$up.''?>").val();
            var fourthQ = $("#fourthQ<?php echo''.$up.''?>").val();
            var average =(parseInt(firstQ) + parseInt(secondQ) + parseInt(thirdQ) + parseInt(fourthQ)) / 2 ;
            var average = Math.round(average);
            var remarks = "";

            if (firstQ == 0 || secondQ == 0 || thirdQ == 0 || fourthQ == 0) {

            }
            else if (average >= 75){
                remarks = "PASSED";
            }else{
                remarks = "FAILED";
            }

                $("#remarks<?php echo''.$up.''?>").val(remarks);

                $("#saveStudentGrade").delay(200).submit();
                $("#autosaved").show();
                $("#autosaved").text("Auto saved");
                $("#autosaved").delay(5000).fadeOut();
            }
        </script>          
    </tbody>
    <?php 
        }
        $firstQ_average = $firstQ_total / $x;
        $secondQ_average = $secondQ_total / $x;
        $thirdQ_average = $thirdQ_total / $x;
        $fourthQ_average = $fourthQ_total / $x;
        $finalGeneralAverage = $final_total / $x;
    ?>
</table>

<?php
    include 'connect.php';
    $student_id = $_POST['student_id'];
    $int = (int)$student_id;

    $query = "SELECT t1.*, t4.subject_name, CONCAT(t7.fname, ' ', LEFT(t7.mname, 1), '. ', t7.lname, ' ', t7.extension) AS 'student', t6.student_subject_id, t3.offered_subject_id
        FROM tbl_grade AS t1
        INNER JOIN tbl_enrollment AS t2 ON t2.enrollment_id = t1.enrollment_id
        INNER JOIN tbl_offered_subject AS t3 ON t3.offered_subject_id = t1.offered_subject_id
        INNER JOIN tbl_subject AS t4 ON t4.subject_id = t3.subject_id
        INNER JOIN tbl_sy AS t5 ON t5.sy_id = t2.sy_id
        INNER JOIN tbl_student_subject AS t6 ON t6.student_subject_id = t1.student_subject_id
        INNER JOIN tbl_student AS t7 ON t7.student_id = t2.student_id
        WHERE t2.student_id = $int LIMIT 1";
                
    $result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_array($result)) {
?> 
<div class="container mb-5">
    <div class="row mb-4" style="font-size: 13px;">
        <div class="col mb-3">
            <label class="text-uppercase fw-bolder">1st Quarter Gen. Average</label>
            <input type="text" name="" class="form-control" value="<?php echo number_format($firstQ_average, 2); ?>" disabled>
        </div>
        <div class="col mb-3">
            <label class="text-uppercase fw-bolder">2nd Quarter Gen. Average</label>
            <input type="text" name="" class="form-control" value="<?php echo number_format($secondQ_average, 2); ?>" disabled>
        </div>
        <div class="col mb-3">
            <label class="text-uppercase fw-bolder">3rd Quarter Gen. Average</label>
            <input type="text" name="" class="form-control" value="<?php echo number_format($thirdQ_average, 2); ?>" disabled>
        </div>
        <div class="col mb-3">
            <label class="text-uppercase fw-bolder">4th Quarter Gen. Average</label>
            <input type="text" name="" class="form-control" value="<?php echo number_format($fourthQ_average, 2); ?>" disabled>
        </div>
        <div class="col mb-3">
            <label class="text-uppercase fw-bolder">Final Gen. Average</label>
            <input type="text" name="" class="form-control" value="<?php echo number_format($finalGeneralAverage, 2); ?>" disabled>
        </div>
        <?php
            if ($finalGeneralAverage >= 90 && $finalGeneralAverage <= 94.99) {
                echo '
                    <div class="col mb-3">
                        <label class="text-uppercase fw-bolder">1st semester ranking</label>
                        <input type="text" name="'.$row["grade_id"].'" class="form-control" value="With Honors" disabled>
                    </div>
                ';
            } elseif ($finalGeneralAverage >= 95 && $finalGeneralAverage <= 97.99) {
                echo '
                    <div class="col mb-3">
                        <label class="text-uppercase fw-bolder">1st semester ranking</label>
                        <input type="text" name="" class="form-control" value="With High Honors" disabled>
                    </div>
                ';
            } elseif ($finalGeneralAverage >= 98 && $finalGeneralAverage <= 100) {
                echo '
                    <div class="col mb-3">
                        <label class="text-uppercase fw-bolder">1st semester ranking</label>
                        <input type="text" name="" class="form-control" value="With Highest Honors" disabled>
                    </div>
                ';
            } else {

            }
        ?>
    </div>
</div>
<?php 
    }
?>