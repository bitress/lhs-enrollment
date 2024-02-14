<!-- Add Faculty -->
<div class="container mt-2 mb-3">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow" id="addGradeLevelForm">
                <div class="card-header">
                    <h5 class="text-uppercase">
                        add grade level
                        <button type="button" class="close" id="closeBtn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                </div>
                <form id="save_grade_level">

                    <div class="card-body">
                    
                        <div class="col-md-11 mb-3">
                            <label for="">Grade Level:</label>
                            <select class="form-control" name="grade_level" id="grade_level">
                                <option value="" selected disabled>--- Select ---</option>
                                <option value="Grade 7">Grade 7</option>
                                <option value="Grade 8">Grade 8</option>
                                <option value="Grade 9">Grade 9</option>
                                <option value="Grade 10">Grade 10</option>
                                <option value="Grade 11">Grade 11</option>
                                <option value="Grade 12">Grade 12</option>
                            </select>
                        </div>
                        <div class="col-md-11 mb-3">
                            <label for="">Section/ STRAND:</label>
                            <input type="text" name="section" id="section" class="form-control" onkeyup="" required>
                        </div>
                        <div class="col-md-11 mb-3">
                            <label for="">Adviser:</label>
                            <select class="form-control" id="adviser_selector" name="faculty_id">
                                <option disabled selected> Search Faculty... </option>
                                <?php
                                    $sql = "SELECT faculty_id, honorifics, fname, mname, lname, title FROM tbl_faculty WHERE status = 1";
                                    $result = mysqli_query($connect, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                    $middle_name = substr($row["mname"], 0, 1);
                                        foreach ($result as $row) {
                                ?>
                                <option value="<?=$row['faculty_id'];?>">
                                    <?=ucwords($row['honorifics']);?> <?=ucwords($row['fname']);?> <?=ucwords(substr($row["mname"], 0, 1));?>. <?=ucwords($row['lname']);?>, <?=ucwords($row['title']);?>
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
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closeBtn" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
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
        <div class="col-md-6">
            <div class="card shadow" id="editGradeLevelForm">
                <div class="card-header">
                    <h5 class="text-uppercase">
                        add grade level
                        <button type="button" class="close" id="closeEditBtn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                </div>
                <form id="update_grade_level">

                    <div class="card-body">
                    
                        <input type="hidden" name="grade_level_id" id="grade_level_id_e" >

                        <div class="col-md-11 mb-3">
                            <label for="">Grade Level:</label>
                            <select class="form-control" name="grade_level" id="grade_level_e">
                                <option value="" selected disabled>--- Select ---</option>
                                <option value="Grade 7">Grade 7</option>
                                <option value="Grade 8">Grade 8</option>
                                <option value="Grade 9">Grade 9</option>
                                <option value="Grade 10">Grade 10</option>
                                <option value="Grade 11">Grade 11</option>
                                <option value="Grade 12">Grade 12</option>
                            </select>
                        </div>
                        <div class="col-md-11 mb-3">
                            <label for="">Section/ STRAND:</label>
                            <input type="text" name="section" id="section_e" class="form-control" onkeyup="" required>
                        </div>
                        <div class="col-md-11 mb-3">
                            <label for="">Adviser:</label>
                            <select class="form-control" id="adviser_selector_e" name="faculty_id">
                                <option disabled selected> Search Faculty... </option>
                                <?php
                                    $sql = "SELECT faculty_id, honorifics, fname, mname, lname, title FROM tbl_faculty WHERE status = 1";
                                    $result = mysqli_query($connect, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                    $middle_name = substr($row["mname"], 0, 1);
                                        foreach ($result as $row) {
                                ?>
                                <option value="<?=$row['faculty_id'];?>">
                                    <?=ucwords($row['honorifics']);?> <?=ucwords($row['fname']);?> <?=ucwords(substr($row["mname"], 0, 1));?>. <?=ucwords($row['lname']);?>, <?=ucwords($row['title']);?>
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
                        
                    </div>
                    <div class="modal-footer">
                        <!--<button type="button" id="closeEditBtn" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>-->
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