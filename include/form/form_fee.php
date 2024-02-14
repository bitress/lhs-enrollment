<!-- Add Faculty -->
<div class="container mt-2 mb-3">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow" id="addOfferedSubjectForm">
                <div class="card-header">
                    <h5 class="text-uppercase">
                        add fees
                        <button type="button" class="close" id="closeBtn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                </div>
                <form id="save_fee">

                    <input type="hidden" class="form-control" name="fee_id" id="fee_id">

                    <div class="card-body">
                    
                        <div class="col-md-12 mb-3">
                            <label for="">Grade Level :</label>
                              <select class="form-control text-capitalize" name="fee_gradelevel" required>
                                    <option value="" > --- Select --- </option>
                                    <?php 

                                        $query = "SELECT DISTINCT grade_level 
                                        FROM tbl_grade_level 
                                        ORDER BY CAST(SUBSTRING(grade_level, 7) AS UNSIGNED) ASC;";
                                        foreach ($connect->query($query) as $row) {
                                            
                                    ?>

                                    <option class="text-capitalize" value="<?php echo $row['grade_level']; ?>"> 
                                        <?php echo $row['grade_level']; ?> 
                                    </option>

                                    <?php 

                                        }

                                    ?>
                              </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">School Year:</label>
                                <select class="form-control text-capitalize" name="fee_sy" id="fee_sy" required>
                                    <option value=""> --- Select --- </option>
                                    <?php 

                                        $query = "SELECT * FROM tbl_sy";

                                        foreach ($connect->query($query) as $row) {
                                            
                                    ?>

                                    <option class="text-capitalize" value="<?php echo $row['sy']; ?>"> 
                                        <?php echo $row['sy']; ?> 
                                    </option>

                                    <?php 

                                        }

                                    ?>
                                </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Fee name:</label>
                            <input type="text" name="fee_name" id="fee_name" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Fee to collect:</label>
                            <input type="number" min="1" name="fee_collect" id="fee_collect" class="form-control" required>
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


<!-- Edit Enrollment -->
<div class="modal fade" id="editSaveFee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light text-uppercase" id="exampleModalLabel">
                    edit fee
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update_fee" autocomplete="off">
                <div class="modal-body text-dark">
                    
                    <input class="form-control" name="edit_fee_id" id="edit_fee_id" hidden>

                    <div class="row justify-content-center">
                        
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="">Fee Name:</label>
                                <input type="text" class="form-control" name="edit_fee_name" id="edit_fee_name" >        
                            </div>
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

<!-- DELETE Enrollment -->
<div class="modal fade" id="deleteSaveFee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light text-uppercase" id="exampleModalLabel">
                    delete fee
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="delete_fee" autocomplete="off">
                <div class="modal-body text-dark">
                    
                    <input class="form-control" name="delete_fee_id" id="delete_fee_id" hidden >

                    <div class="row justify-content-center">
                        
                        <div class="col-md-6">
                            Press save to delete this fee.
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