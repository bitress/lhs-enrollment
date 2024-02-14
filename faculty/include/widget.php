                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-12 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Students
                                            </div>
                                                <?php
                                                    if(isset($_SESSION['faculty_id'])){
                                                        $faculty_id=$_SESSION['faculty_id'];

                                                        include 'connect.php';
                                                        $sql = "SELECT t1.enrollment_id, t2.student_id, t2.fname, t2.mname, t2.lname, t2.lrn, t2.extension, t2.gender, CURDATE(), TIMESTAMPDIFF(YEAR, t2.birthdate, CURDATE()) AS 'age', t3.grade_level_section, t4.faculty_id, CONCAT(t4.honorifics, ' ', t4.lname) AS 'adviser', t5.*
                                                            FROM tbl_enrollment AS t1
                                                            INNER JOIN tbl_student AS t2 ON t2.student_id = t1.student_id
                                                            INNER JOIN tbl_grade_level AS t3 ON t3.grade_level_id = t1.grade_level_id
                                                            INNER JOIN tbl_faculty AS t4 ON t4.faculty_id = t3.faculty_id
                                                            INNER JOIN tbl_sy AS t5 ON t5.sy_id = t1.sy_id
                                                            WHERE t3.faculty_id = $faculty_id
                                                            ORDER BY t2.gender DESC, t2.lname ASC";
                                                        $result = mysqli_query($connect, $sql);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            $students = mysqli_num_rows($result);
                                                ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $students; ?>
                                            </div>
                                                <?php 
                                                    }else{
                                                      echo "

                                                        <div class='alert alert-info text-dark text-uppercase' role='alert'>
                                                          No student enrolled yet
                                                        </div>

                                                      " ;
                                                    }
                                                  }
                                                ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->