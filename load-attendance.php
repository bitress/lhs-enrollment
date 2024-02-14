<?php 
    include 'connect.php';
    $student_id = $_POST['student_id'];
    $int = (int)$student_id;

    $query = "SELECT t1.*, t3.*, t5.grade_level, t5.grade_level_section, t4.month, t6.sy
        FROM tbl_attendance AS t1
        INNER JOIN tbl_enrollment AS t2 ON t2.enrollment_id = t1.enrollment_id
        INNER JOIN tbl_student AS t3 ON t3.student_id = t2.student_id
        INNER JOIN tbl_month AS t4 ON t4.month_id = t1.month_id
        INNER JOIN tbl_grade_level AS t5 ON t5.grade_level_id = t2.grade_level_id
        INNER JOIN tbl_sy AS t6 ON t6.sy_id = t2.sy_id
        WHERE t3.student_id = $int";
                
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result)
?>
<div class="row">
    <div class="col mb-3">
        <label class="text-uppercase fw-bolder">Student Name</label>
        <input type="text" name="" class="form-control text-capitalize" value="<?php echo $row['fname']; ?> <?php echo substr($row["mname"], 0, 1); ?>. <?php echo $row['lname']; ?> <?php echo $row['extension']; ?>" disabled>
    </div>
     <div class="col mb-3">
        <label class="text-uppercase fw-bolder">Grade Level</label>
        <input type="text" name="" class="form-control text-capitalize" value="<?php echo $row['grade_level_section']; ?>" disabled>
    </div>
    <div class="col mb-3">
        <label class="text-uppercase fw-bolder">School Year</label>
        <input type="text" name="" class="form-control text-capitalize" value="<?php echo $row['sy']; ?>" disabled>
    </div>
</div>
<?php ?>

<!-- attendance sheet -->
<table class="table table-bordered">
    <thead class="table-info" style="font-size: 13px;">
         <tr>
            <!--<th class="text-center" style="vertical-align: middle;"  rowspan="2">
                <input type='checkbox' id='checkAll' > Select All
            </th>-->
            <th class="text-center" style="vertical-align: middle;"  rowspan="2"> Month of </th>
            <th class="text-center" style="vertical-align: middle; width: 25%;"  rowspan="2"> Days of Classes </th>
            <th class="text-center" style="vertical-align: middle; width: 20%;"  colspan="2"> Days </th>
        </tr>
        <tr>
            <th class="text-center" style="width: 20%;"> Present </th>
            <th class="text-center" style="width: 20%;"> Absent </th>
        </tr>
    </thead>
    <?php
        include 'connect.php';
        $student_id = $_POST['student_id'];
        $int = (int)$student_id;

        $query = "SELECT t1.*, CONCAT(t3.fname, ' ', LEFT(t3.mname, 1), '. ', t3.lname, ' ', t3.extension) AS 'student_name', t4.month
            FROM tbl_attendance AS t1
            INNER JOIN tbl_enrollment AS t2 ON t2.enrollment_id = t1.enrollment_id
            INNER JOIN tbl_student AS t3 ON t3.student_id = t2.student_id
            INNER JOIN tbl_month AS t4 ON t4.month_id = t1.month_id
            WHERE t3.student_id = $int
            ORDER BY t3.lname";
                
        $result = mysqli_query($connect, $query);
        $up = 0;
    ?>
        <tr style="display: none;">
            <td colspan="8">
                <input type="hidden" name="student_id" value="<?php echo''.$int.''; ?>">
            </td>
        </tr>
    <?php
        while ($row = mysqli_fetch_array($result)) {
        $up++;
    ?>
    <tbody>
        <tr class="text-uppercase">
            <td style="display: none;">
                <input type="hidden" id="attendance_id" name="attendance_id[]" value="<?php echo $row["attendance_id"] ?>"> 
            </td>
            <td class="text-center"> <?php echo $row["month"] ?> </td>
            <td class="text-center"> 
                <input type="number" name="schoolDays[]" 
               value="<?php echo $row["schoolDays"] ?>" class="form-control schoolDays" id="schoolDays<?php echo''.$up.''?>" oninput="input_attendance<?php echo''.$up.''?>()"> 
           </td>
            <td class="text-center"> 
                <input type="number" name="daysPresent[]"
               value="<?php echo $row["daysPresent"] ?>" class="form-control daysPresent" id="daysPresent<?php echo''.$up.''?>" oninput="input_attendance<?php echo''.$up.''?>()" readonly> 
           </td>
            <td class="text-center"> 
                <input type="number" name="daysAbsent[]"
               value="<?php echo $row["daysAbsent"] ?>" class="form-control daysAbsent" id="daysAbsent<?php echo''.$up.''?>" oninput="input_attendance<?php echo''.$up.''?>()"> 
           </td>
        </tr>
        <script>
        function input_attendance<?php echo''.$up.''?>(){

            var schoolDays = 0;
            var daysAbsent = 0;

            var schoolDays = $("#schoolDays<?php echo''.$up.''?>").val();
            var daysAbsent = $("#daysAbsent<?php echo''.$up.''?>").val();
            var daysPresent = parseInt(schoolDays) - parseInt(daysAbsent);
            var remarks = "";

                $("#daysPresent<?php echo''.$up.''?>").val(daysPresent);

                $("#saveStudentAttendance").delay(200).submit();
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

<!--<script>
$(document).ready(function() {
    $(".schoolDays, .daysAbsent").keyup(function() {
        
        var student_attendance_id = $(this).attr("id");
        var daysPresent_input = student_attendance_id.slice(11);
        //alert(daysPresent_input);
        var daysPresent = 0;
        var schoolDays = Number($("#schoolDays-"+daysPresent_input).val());
        var daysAbsent = Number($("#daysAbsent-"+daysPresent_input).val());
        var daysPresent = schoolDays - daysAbsent;
       
        //alert(schoolDays+daysPresent);
        //alert(daysPresent_input);

        $("#daysPresent"+daysPresent_input).val(daysPresent);
    });
});
</script>-->

<!--<script type="text/javascript">
//check box
$(document).ready(function(){
    // Check/Uncheck ALl
    $('#checkAll').change(function(){
    	if($(this).is(':checked')){
            $('input[name="update[]"]').prop('checked',true);
        }else{
            $('input[name="update[]"]').each(function(){
           	 	$(this).prop('checked',false);
        	}); 
    	}
    });
    // Checkbox click
    $('input[name="update[]"]').click(function(){
        var total_checkboxes = $('input[name="update[]"]').length;
        var total_checkboxes_checked = $('input[name="update[]"]:checked').length;
 
        if(total_checkboxes_checked == total_checkboxes){
            $('#checkAll').prop('checked',true);
        }else{
            $('#checkAll').prop('checked',false);
        }
    });
});
</script>-->