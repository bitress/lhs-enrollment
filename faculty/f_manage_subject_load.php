<?php  
  
    session_start();
    include 'connect.php';

    if (isset($_SESSION['username']) && ($_SESSION['faculty_id'])) {
    }
    else{

      header("location: ../login.php");
      
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
                        <h1 class="h3 mb-0 text-gray-800">SUBJECT LOAD</h1>
                    </div>

                    <!-- Content -->

                    <?php include 'include/form/form_student.php'; ?>

                    <div class="container mt-4 mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <h4 class="text-uppercase">
                                            
                                            <i class="fas fa-book-open"></i> List of Subjects
                                           
                                        </h4>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table id="myTable" class="table table-bordered table-hover">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th class="text-center"> Name </th>
                                                    <th class="text-center"> Grade Level & Section </th>
                                                    <th class="text-center"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if(isset($_SESSION['faculty_id'])){
                                                        $faculty_id=$_SESSION['faculty_id'];

                                                        include 'connect.php';
                                                        $sql = "SELECT t1.offered_subject_id, t1.status, t3.subject_name, TRIM('Grade ' FROM t4.grade_level_section) AS 'grade_level' , t5.sy
                                                              FROM tbl_offered_subject AS t1
                                                              INNER JOIN tbl_faculty AS t2 ON t2.faculty_id = t1.faculty_id 
                                                              INNER JOIN tbl_subject AS t3 ON t3.subject_id = t1.subject_id
                                                              INNER JOIN tbl_grade_level AS t4 ON t4.grade_level_id = t1.grade_level_id
                                                              INNER JOIN tbl_sy AS t5 ON t5.sy_id = t1.sy_id
                                                              WHERE t1.faculty_id = $faculty_id AND t1.status = 1";
                                                        $result = mysqli_query($connect, $sql);
                                                        while ($row = mysqli_fetch_array($result)) {
                                                ?>

                                                <tr>
                                                    <td class="text-center"> 
                                                        <?php echo $row["subject_name"] ?>
                                                    </td>
                                                    <td class="text-center text-uppercase">
                                                        <?php echo $row["grade_level"] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" value="<?php echo $row["offered_subject_id"] ?>" class="viewStudentGradesBtn btn btn-warning btn-sm">
                                                            <i class="fas fa-award"></i> View Grades
                                                        </button>
                                                    </td>
                                                </tr>

                                                <?php 
                                                        }
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

    <!-- Logout Modal-->
    <?php include 'include/logout.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- Alertify -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- View Grades -->
    <div class="modal fade" id="gradeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-light text-uppercase" id="exampleModalLabel">
                        enter student grade
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="saveStudentGrade" action="" method="POST">
                    <div class="modal-body">

                        <span ><i id="autosaved"></i>&nbsp</span>
                        <div id="load_students"></div>

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

    <script>
        function numbersonly(input) {
            var regex = /[^0-9]/g;
            input.value = input.value.replace(regex, "");
        }
    </script>

    <script type="text/javascript">
        //view student 1
        $(document).on('click', '.viewStudentGradesBtn', function () {

            var offered_subject_id = $(this).val();
            //alert(offered_subject_id);  
            $.ajax({
                type: "POST",
                url: "load-student_grades.php",
                data: {offered_subject_id: offered_subject_id},
                success: function (response) {
                    //alert(response);
                    /*var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);

                    }else if(res.status == 200){*/
                        $('#gradeModal').modal('show');
                        $('#load_students').html(response);
                    //}

                }
            });

        });

        //add 1
        $(document).on('submit', '#saveStudentGrade', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_grade", true);

            $.ajax({
                type: "POST",
                url: "code-save_student_grades.php",
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
                        $('#gradeModal').modal('hide');
                        $('#saveStudentGrade')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        //view
        $(document).on('click', '.viewStudentBtn', function () {

            var student_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "../action/code-student.php?student_id=" + student_id,
                success: function (response) {
                  
                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){
                        
                        $('#lrn_v').val(res.data.lrn);
                        $('#fname_v').val(res.data.fname);
                        $('#mname_v').val(res.data.mname);
                        $('#lname_v').val(res.data.lname);
                        $('#extension_v').val(res.data.extension);
                        $('#gender_v').val(res.data.gender);
                        $('#birthdate_v').val(res.data.birthdate);

                        $('#viewStudentModal').modal('show');
                    }
                }
            });
        });
    </script>

<!-- Bottom Section-->
<?php include 'include/botSection.php'; ?>