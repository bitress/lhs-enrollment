<?php
    include 'connect.php';
    $offered_subject_id = $_POST['offered_subject_id'];
    $int = (int)$offered_subject_id;

    $query = "SELECT t1.offered_subject_id, t2.subject_name, t3.grade_level_section, t4.sy, CONCAT(t5.honorifics, ' ', t5.lname) AS 'subject_teacher'
        FROM tbl_offered_subject AS t1
        INNER JOIN tbl_subject AS t2 ON t2.subject_id = t1.subject_id
        INNER JOIN tbl_grade_level AS t3 ON t3.grade_level_id = t1.grade_level_id
        INNER JOIN tbl_sy AS t4 ON t4.sy_id = t1.sy_id
        INNER JOIN tbl_faculty AS t5 ON t5.faculty_id = t1.faculty_id
        WHERE t1.offered_subject_id = $int";
                
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) > 0 ){
    $row = mysqli_fetch_array($result)
    //$mname = substr($row["mname"], 0, 1);
?>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="text-uppercase fw-bolder">Subject</label>
        <input type="text" name="" class="form-control text-capitalize" value="<?php echo $row['subject_name']; ?>" disabled>
    </div>
    <div class="col-md-4 mb-3">
        <label class="text-uppercase fw-bolder">Subject Teacher</label>
        <input type="text" name="" class="form-control text-capitalize" value="<?php echo $row['subject_teacher']; ?>" disabled>
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
        $offered_subject_id = $_POST['offered_subject_id'];
        $int = (int)$offered_subject_id;

        $query = "SELECT t1.*, t4.subject_name, t7.fname, LEFT(t7.mname, 1) AS 'mname', t7.lname, t7.extension, t7.gender, t6.student_subject_id, t3.offered_subject_id, t5.sy, t5.firstQ_status, t5.secondQ_status, t5.thirdQ_status, t5.fourthQ_status
            FROM tbl_grade AS t1
            INNER JOIN tbl_enrollment AS t2 ON t2.enrollment_id = t1.enrollment_id
            INNER JOIN tbl_offered_subject AS t3 ON t3.offered_subject_id = t1.offered_subject_id
            INNER JOIN tbl_subject AS t4 ON t4.subject_id = t3.subject_id
            INNER JOIN tbl_sy AS t5 ON t5.sy_id = t2.sy_id
            INNER JOIN tbl_student_subject AS t6 ON t6.student_subject_id = t1.student_subject_id
            INNER JOIN tbl_student AS t7 ON t7.student_id = t2.student_id
            WHERE t3.offered_subject_id = $int
            ORDER BY t7.gender DESC, t7.lname ASC, t4.subject_id";
           
        $result = mysqli_query($connect, $query);
            $up = 0;
    ?>
        <tr style="display: none;">
            <td colspan="8">
                <input type="text" name="offered_subject_id" value="<?php echo''.$int.''; ?>">
            </td>
        </tr>
    <?php
        while ($row = mysqli_fetch_array($result)) {

            $up++;

    ?>
    <tbody>
        <tr class="text-uppercase">
             <td style="display: none;">
                <input type="hidden" id="grade_id" name="grade_id[]" value="<?php echo $row["grade_id"] ?>"> 
            </td>
            <td class="text-center"> 
                <?php echo $row["fname"] ?> <?php echo $row["mname"] ?>. <?php echo $row["lname"] ?> <?php echo $row["extension"] ?> 
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
    ?>
</table>