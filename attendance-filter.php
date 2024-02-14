<?php 

include 'connect.php';

if (isset($_POST['request'])) {
	
	$request = $_POST['request']; 

	$query = "SELECT t1.student_id, t2.*, t3.grade_level_section, t4.sy
		FROM tbl_enrollment AS t1
		INNER JOIN tbl_student AS t2 ON t1.student_id = t2.student_id 
		INNER JOIN tbl_grade_level AS t3 ON t1.grade_level_id = t3.grade_level_id 
		INNER JOIN tbl_sy AS t4 ON t1.sy_id = t4.sy_id
		WHERE t3.grade_level_id = '$request'
        ORDER BY t2.gender DESC, t2.lname ASC";
	$result = mysqli_query($connect, $query);
	$count = mysqli_num_rows($result);

?>

<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h4><i class="fas fa-users"></i> Students List
                              
                    	<!--<button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
                            <i class='bx bxs-book-add'></i> Add Subject
                        </button>-->
                    </h4>
                </div>
                <div class="card-body table-responsive">

                    <table id="myTable" class="table table-hover table-bordered">
					<?php 

						if ($count) {

					?>
						<thead class="table-info" style="font-size: 15px;">
					        <tr>
                                <th class="text-center"> Student Name </th>
                                <th class="text-center"> Gender </th>
                                <th class="text-center"> Grade Level & Section </th>
                                <th class="text-center"> School Year </th>
                                <th class="text-center"> Action </th>
					        </tr>
					<?php 

						}

						else {

							echo "No Records Found";

						}

					?>
					    </thead>
					    <tbody>
					        <?php

					        	while ($row = mysqli_fetch_array($result)) {
                                    $middle_name = substr($row["mname"], 0, 1);
					        ?>
					        <!-- Table Content -->
					        <tr class="text-capitalize">
					            <td> <?php echo $row["fname"] ?> <?php echo $middle_name ?>. <?php echo $row["lname"] ?> <?php echo $row["extension"] ?> </td>
                                <td class="text-center"> <?php echo $row["gender"] ?> </td>
					            <td class="text-center"> <?php echo $row["grade_level_section"] ?> </td>
                                <td class="text-center"> <?php echo $row["sy"] ?> </td>
					            <td class="text-center">
					                <button type="button" value="<?php echo $row["student_id"] ?>" class="attendanceSheetBtn btn btn-info btn-sm"><i class="fas fa-eye me-1"></i> Attendance </button>
                                </td>
					        </tr>
					        <!-- End of Table Content -->
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

<!-- View Student Modal 1 -->
<div class="modal fade" id="displayAttendaneSheet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light text-uppercase" id="exampleModalLabel">
                    student attendance
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="saveStudentAttendance" action="" method="POST">
                <div class="modal-body">

                    <span ><i id="autosaved"></i>&nbsp</span>
                    <div id="load_attendance"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- DataTable -->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myTable').DataTable();
    });
</script>

<script type="text/javascript">
    //view student 1
    $(document).on('click', '.attendanceSheetBtn', function () {

        var student_id = $(this).val();
        //alert(student_id);  
        $.ajax({
            type: "POST",
            url: "load-attendance.php",
            data: {student_id: student_id},
            success: function (response) {
                //alert(response);
                /*var res = jQuery.parseJSON(response);
                if(res.status == 404) {

                    alert(res.message);

                }else if(res.status == 200){*/
                    $('#displayAttendaneSheet').modal('show');
                    $('#load_attendance').html(response);
                //}

            }
        });

    });

    //add 1
    $(document).on('submit', '#saveStudentAttendance', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("save_attendance", true);

        $.ajax({
            type: "POST",
            url: "action/code-save_attendance.php",
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
                    $('#displayStudentAttendanceSheet').modal('hide');
                    $('#saveStudentAttendance')[0].reset();

                    alertify.set('notifier','position', 'top-right');
                    alertify.success(res.message);

                    $('#myTable2').load(location.href + " #myTable2");

                }else if(res.status == 500) {
                    alert(res.message);
                }
            }
        });

    });
</script>

<?php

    }

?>