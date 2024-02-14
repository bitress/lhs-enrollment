<!-- Add Faculty -->
<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light text-uppercase" id="exampleModalLabel">
                    add new student
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="save_student" autocomplete="off">
                <div class="modal-body text-dark">
                    
                    <div class="row">

                        <!-- row 1 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">LRN:</label>
                                <input type="text" name="lrn" id="lrn" class="form-control" onkeyup="numbersonly(this)" required>
                            </div>
                            <div class="mb-3">
                                <label for="">First Name:</label>
                                <input type="text" name="fname" id="fname" class="form-control" onkeyup="lettersonlyName(this)" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Middle Name:</label>
                                <input type="text" name="mname" id="mname" class="form-control" onkeyup="lettersonlyName(this)" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Last Name:</label>
                                <input type="text" name="lname" id="lname" class="form-control" onkeyup="lettersonlyName(this)" required>
                            </div>
                        </div>

                        <!-- row 2 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">Name Extension:</label>
                                <input type="text" name="extension" id="extension" class="form-control" onkeyup="lettersonlyName(this)">
                            </div>
                            <div class="mb-3">
                                <label for="">Gender</label>
                                <select class="form-control" name="gender" required>
                                  <option selected>--- Select ---</option>
                                  <option value="Male"> Male </option>
                                  <option value="Female"> Female </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Birthdate:</label>
                                <input type="date" name="birthdate" class="form-control" placeholder="mm/dd/yyyy"  id="birthdate" required>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================================================================================================== -->

<!-- Edit Faculty -->
<div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light text-uppercase" id="exampleModalLabel">
                    edit student information
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update_student" autocomplete="off">
                <div class="modal-body text-dark">
                    
                    <input type="hidden" name="student_id" id="student_id_e" >

                    <div class="row">

                        <!-- row 1 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">LRN:</label>
                                <input type="text" name="lrn" id="lrn_e" class="form-control" onkeyup="numbersonly(this)" required>
                            </div>
                            <div class="mb-3">
                                <label for="">First Name:</label>
                                <input type="text" name="fname" id="fname_e" class="form-control" onkeyup="lettersonlyName(this)" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Middle Name:</label>
                                <input type="text" name="mname" id="mname_e" class="form-control" onkeyup="lettersonlyName(this)" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Last Name:</label>
                                <input type="text" name="lname" id="lname_e" class="form-control" onkeyup="lettersonlyName(this)" required>
                            </div>
                        </div>

                        <!-- row 2 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">Name Extension:</label>
                                <input type="text" name="extension" id="extension_e" class="form-control" onkeyup="lettersonlyName(this)">
                            </div>
                            <div class="mb-3">
                                <label for="">Gender</label>
                                <select class="form-control" name="gender" id="gender_e" required>
                                  <option selected>--- Select ---</option>
                                  <option value="Male"> Male </option>
                                  <option value="Female"> Female </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Birthdate:</label>
                                <input type="date" name="birthdate" id="birthdate_e" class="form-control" placeholder="mm/dd/yyyy"  id="birthdate" required>
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

<!-- ================================================================================================== -->

<!-- View Faculty -->
<div class="modal fade" id="viewStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light text-uppercase" id="exampleModalLabel">
                    view student information
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update_student" autocomplete="off">
                <div class="modal-body text-dark">
                    
                    <input type="hidden" name="student_id" id="student_id_v" >

                    <div class="row">

                        <!-- row 1 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">LRN:</label>
                                <input type="text" name="lrn" id="lrn_v" class="form-control" onkeyup="numbersonly(this)" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="">First Name:</label>
                                <input type="text" name="fname" id="fname_v" class="form-control" onkeyup="lettersonlyName(this)" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="">Middle Name:</label>
                                <input type="text" name="mname" id="mname_v" class="form-control" onkeyup="lettersonlyName(this)" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="">Last Name:</label>
                                <input type="text" name="lname" id="lname_v" class="form-control" onkeyup="lettersonlyName(this)" disabled>
                            </div>
                        </div>

                        <!-- row 2 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">Name Extension:</label>
                                <input type="text" name="extension" id="extension_v" class="form-control" onkeyup="lettersonlyName(this)" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="">Gender</label>
                                <select class="form-control" name="gender" id="gender_v" disabled>
                                  <option selected>--- Select ---</option>
                                  <option value="Male"> Male </option>
                                  <option value="Female"> Female </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Birthdate:</label>
                                <input type="date" name="birthdate" id="birthdate_v" class="form-control" placeholder="mm/dd/yyyy"  id="birthdate" disabled>
                            </div>
                        </div>

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