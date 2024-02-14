<!-- Add Faculty -->
<div class="container mt-2 mb-3">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow" id="addOfferedSubjectForm">
                <div class="card-header">
                    <h5 class="text-uppercase">
                        add offered subject
                        <button type="button" class="close" id="closeBtn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                </div>
                <form id="save_offered_subject">

                    <div class="card-body">
                    
                        <div class="col-md-12 mb-3">
                            <label for="">Teacher:</label>
                            <select class="form-control" id="teacher_selector" name="faculty_id">
                                <option disabled selected> Search Faculty... </option>
                                <?php
                                    $sql = "SELECT faculty_id, honorifics, fname, mname, lname, title, userType FROM tbl_faculty WHERE status = 1 AND userType != 'cashier'";
                                    $result = mysqli_query($connect, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                    $middle_name = substr($row["mname"], 0, 1);
                                        foreach ($result as $row) {
                                ?>
                                <option value="<?=$row['faculty_id'];?>">
                                    <?=$row['honorifics'];?> <?=$row['fname'];?> <?=$middle_name;?>. <?=$row['lname'];?>, <?=$row['title'];?>
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
                        <div class="col-md-12 mb-3">
                            <label for="">Subject:</label>
                            <select class="form-control" id="subject_selector" name="subject_id">
                                <option disabled selected> Search Subject... </option>
                                <?php
                                    $sql = "SELECT subject_id, subject_name FROM tbl_subject WHERE status = 1";
                                    $result = mysqli_query($connect, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        foreach ($result as $row) {
                                ?>
                                <option value="<?=$row['subject_id'];?>">
                                    <?=$row['subject_name'];?> 
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
                        <div class="col-md-12 mb-3">
                            <label for="">Grade Level & Section:</label>
                              <select class="form-control text-capitalize" name="grade_level_id">
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
                        <div class="col-md-12 mb-3">
                            <label for="">School Year:</label>
                                <select class="form-control text-capitalize" name="sy_id" id="sy_id">
                                    <option disabled selected> --- Select --- </option>
                                    <?php 

                                        $query = "SELECT * FROM tbl_sy";

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
                        <div class="col-md-12 mb-3">
                            <label for="">No. of Hours/Semester:</label>
                            <input type="text" name="hrsSem" id="hrsSem" class="form-control" onkeyup="numbersonly(this)" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">No. of Hours/Week:</label>
                            <input type="text" name="hrsWeek" id="hrsWeek" class="form-control" onkeyup="numbersonly(this)" required>
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label for="">No. of Units:</label>
                            <input type="text" name="units" id="units" class="form-control" onkeyup="numbersonly(this)" required>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <!--<button type="button" id="closeBtn" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>-->
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================================================== -->

<!-- Edit Faculty -->
<div class="container mt-2 mb-3">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow" id="editOfferedSubjectForm">
                <div class="card-header">
                    <h5 class="text-uppercase">
                        add grade level
                        <button type="button" class="close" id="closeEditBtn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                </div>
                <form id="update_offered_subject">

                    <input type="hidden" name="offered_subject_id" id="offered_subject_id_e" >

                    <div class="card-body">
                    
                        <div class="col-md-12 mb-3">
                            <label for="">Teacher:</label>
                            <select class="form-control" id="teacher_selector_e" name="faculty_id">
                                <option disabled selected> Search Faculty... </option>
                                <?php
                                    $sql = "SELECT faculty_id, honorifics, fname, mname, lname, title, userType FROM tbl_faculty WHERE status = 1 AND userType != 'cashier'";
                                    $result = mysqli_query($connect, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                    $middle_name = substr($row["mname"], 0, 1);
                                        foreach ($result as $row) {
                                ?>
                                <option value="<?=$row['faculty_id'];?>">
                                    <?=$row['honorifics'];?> <?=$row['fname'];?> <?=$middle_name;?>. <?=$row['lname'];?>, <?=$row['title'];?>
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
                        <div class="col-md-12 mb-3">
                            <label for="">Subject:</label>
                                <select class="form-control text-capitalize" name="subject_id" id="subject_id_e" disabled>
                                    <option disabled selected> --- Select --- </option>
                                    <?php 

                                        $query = "SELECT * FROM tbl_subject WHERE status = 1";

                                        foreach ($connect->query($query) as $row) {
                                            
                                    ?>

                                    <option class="text-capitalize" value="<?php echo $row['subject_id']; ?>"> 
                                        <?php echo $row['subject_name']; ?> 
                                    </option>

                                    <?php 

                                        }

                                    ?>
                                </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Grade Level & Section:</label>
                                <select class="form-control text-capitalize" name="grade_level_id" id="grade_level_id_e">
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
                        <div class="col-md-12 mb-3">
                            <label for="">School Year:</label>
                                <select class="form-control text-capitalize" name="sy_id" id="sy_id_e">
                                    <option disabled selected> --- Select --- </option>
                                    <?php 

                                        $query = "SELECT * FROM tbl_sy";

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
                        <div class="col-md-12 mb-3">
                            <label for="">No. of Hours/Semester:</label>
                            <input type="text" name="hrsSem" id="hrsSem_e" class="form-control" onkeyup="numbersonly(this)" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">No. of Hours/Week:</label>
                            <input type="text" name="hrsWeek" id="hrsWeek_e" class="form-control" onkeyup="numbersonly(this)" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="">No. of Units:</label>
                            <input type="text" name="units" id="units_e" class="form-control" onkeyup="numbersonly(this)" required>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <!--<button type="button" id="closeBtn" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>-->
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    </div>

                </form>
            </div>
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
                    
                    <input type="hidden" name="offered_subject_id" id="offered_subject_id_v" >

                    <div class="mb-3">
                        <label for="">Teacher:</label>
                        <input type="text" name="" id="" class="form-control" onkeyup="numbersonly(this)" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="">Subject Name:</label>
                        <input type="text" name="subject_name" id="subject_name_v" class="form-control" onkeyup="numbersonly(this)" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="">Grade Level & Section:</label>
                        <input type="text" name="subject_name" id="subject_name_v" class="form-control" onkeyup="numbersonly(this)" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="">School Year:</label>
                        <input type="text" name="subject_name" id="subject_name_v" class="form-control" onkeyup="numbersonly(this)" disabled>
                    </div>

                    <div class=" mb-3">
                            <label for="">No. of Units:</label>
                            <input type="text" name="units" id="units_v" class="form-control" onkeyup="numbersonly(this)" required>
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