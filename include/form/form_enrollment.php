<!-- Enroll Student -->
<div class="container mt-2 mb-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow" id="enrollmentForm">
                <div class="card-header">
                    <h5 class="text-uppercase">
                        student enrollment
                        <button type="button" class="close" id="closeBtn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                </div>
                <form id="save_enrollment" class="form">

                    <div class="card-body">
                    
                        <div class="row">
                            
                            <div class="col-md-6">
                                
                                <div id="last_row_id">
                                    <?php
                                        $idquery = "SELECT enrollment_id FROM tbl_enrollment ORDER BY enrollment_id DESC LIMIT 1;";
                                        $result = mysqli_query($connect, $idquery);
                                        $count = mysqli_num_rows($result);

                                    if ($count) {
                                        while ($row = mysqli_fetch_array($result)){
                                                        $last_id = $row['enrollment_id'];

                                            echo'<input type="hidden" class="form-control col-sm-2" name="enrollment_id" value="'.$last_id.'" readonly>';
                                        }
                                    }else{
                                            echo'<input type="hidden" class="form-control col-sm-2" name="enrollment_id" value="0" readonly>';
                                    }
                                    ?>
                                </div>

                                <div class="mb-3">
                                    <label for="">Student Name:</label>
                                    <select class="form-control" id="student_selector" name="student_id">
                                        <option disabled selected> Search Student... </option>
                                        <?php
                                            $sql = "SELECT `student_id`, `lrn`, `fname`, `mname`, `lname`, `extension`, `gender`, `birthdate`, CURDATE(), TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) as `age`, `status`
                                                            FROM `tbl_student` WHERE `status` = 1";
                                            $result = mysqli_query($connect, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                            $middle_name = substr($row["mname"], 0, 1);
                                                foreach ($result as $row) {
                                        ?>
                                        <option value="<?=$row['student_id'];?>">
                                            <?=ucwords($row['fname']);?> <?=ucwords(substr($row["mname"], 0, 1));?>. <?=ucwords($row['lname']);?> <?=ucwords($row['extension']);?>
                                        </option>
                                        <?php
                                                }
                                            }else{
                                        ?>
                                        <option value="">
                                            No Record Found
                                        </option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                  <label for="" id="lrn1">LRN:</label>
                                </div>

                            </div>

                            <div class="col-md-6">
                                
                                <div class="mb-3">
                                    <label for="">Grade Level:</label>
                                    <select class="form-control text-capitalize" name="grade_level_id" id="grade_level_section_selector">
                                        <option disabled selected> --- Select --- </option>
                                        <?php 
                                            $query = "SELECT * FROM tbl_grade_level ORDER BY grade_level";
                                            foreach ($connect->query($query) as $row) {               
                                        ?>

                                        <option class="text-capitalize" value="<?php echo $row['grade_level_id']; ?>"> 
                                            <?php echo $row['grade_level_section']; ?> 
                                        </option>

                                        <?php 
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">School Year:</label>
                                    <select class="form-control text-capitalize" name="sy_id" id="">
                                        <?php 
                                            $query = "SELECT DISTINCT sy_id, sy, sy_status FROM tbl_sy WHERE sy_status = 1";
                                            foreach ($connect->query($query) as $row) {               
                                        ?>
                                        <option class="text-capitalize" value="<?php echo $row['sy_id']; ?>"> 
                                            <?php echo $row['sy']; ?> 
                                        </option>
                                        <?php 
                                            }
                                        ?>
                                    </select>
                                </div>

                            </div>

                        </div>

                        <div class="card mt-2" id="subjects_header">
                            <h5 class="card-header text-uppercase fw-bolder">
                                Subjects List
                            </h5>
                            <div class="card-body table-responsive" id="container">
                                <table class="table table-hover table-bordered">
                                    <thead class="table-info">
                                        <tr>
                                            <th class="text-center"> Subjects </th>
                                            <th class="text-center"> Grade Level </th>
                                            <th class="text-center"> Section/ STRAND </th>
                                            <th class="text-center"> Teacher </th>
                                        </tr>
                                    </thead>
                                    <tbody id="subjects1" name="subject_id">
                                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" id="closeBtn" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button> -->
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================================================== -->

<!-- Edit Enrollment -->
<div class="modal fade" id="editEnrollmentForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light text-uppercase" id="exampleModalLabel">
                    edit enrollment
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update_enrollment" autocomplete="off">
                <div class="modal-body text-dark">
                    
                    <input type="hidden" class="form-control" name="student_id" id="student_id_e">
                    <input type="hidden" class="form-control" name="enrollment_id" id="enrollment_id_e">

                    <div class="row">
                        
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="">Student Name:</label>
                                <input type="text" class="form-control" name="student_name" id="student_name_e" readonly>        
                            </div>
                            <div class="mb-3">
                                <label for="" id="lrn2">LRN:</label>
                                <input type="text" class="form-control" name="lrn" id="lrn_e" readonly>
                            </div>

                        </div>

                        <div class="col-md-6">
                            
                            <div class="mb-3">
                                <label for="">Grade Level:</label>
                                <select class="form-control text-capitalize" name="grade_level_id" id="grade_level_section_selector_e">
                                    <option disabled selected> --- Select --- </option>
                                    <?php 
                                        $query = "SELECT * FROM tbl_grade_level ORDER BY grade_level";
                                        foreach ($connect->query($query) as $row) {               
                                    ?>

                                    <option class="text-capitalize" value="<?php echo $row['grade_level_id']; ?>"> 
                                        <?php echo $row['grade_level_section']; ?> 
                                    </option>

                                    <?php 
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="">School Year:</label>
                                <select class="form-control text-capitalize" name="sy_id" id="sy_e">
                                    <?php 
                                        $query = "SELECT DISTINCT sy_id, sy, sy_status FROM tbl_sy WHERE sy_status = 1";
                                        foreach ($connect->query($query) as $row) {               
                                    ?>
                                    <option class="text-capitalize" value="<?php echo $row['sy_id']; ?>"> 
                                        <?php echo $row['sy']; ?> 
                                    </option>
                                    <?php 
                                        }
                                    ?>
                                </select>
                            </div>

                        </div>

                    </div>

                    <div class="card mt-2" id="subjects_header">
                        <h5 class="card-header text-uppercase fw-bolder">
                            Subjects List
                        </h5>
                        <div class="card-body table-responsive" id="container">
                            <table class="table table-hover table-bordered">
                                <thead class="table-info">
                                    <tr>
                                        <th class="text-center"> Subjects </th>
                                        <th class="text-center"> Grade Level </th>
                                        <th class="text-center"> Section/ STRAND </th>
                                        <th class="text-center"> Teacher </th>
                                    </tr>
                                </thead>
                                <tbody id="subject_e" name="subject_id">
                                            
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                    <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================================================================================================== -->

<!-- View Faculty -->
<div class="modal fade" id="viewSubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light text-uppercase" id="exampleModalLabel">
                    view faculty account information
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update_student" autocomplete="off">
                <div class="modal-body text-dark">
                    
                    <input type="hidden" name="subject_id" id="subject_id_v" >

                    <div class="mb-3">
                        <label for="">Subject Name:</label>
                        <input type="text" name="subject_name" id="subject_name_v" class="form-control" onkeyup="numbersonly(this)" disabled>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                    <!--<button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Save Changes</button>-->
                </div>
            </form>
        </div>
    </div>
</div>