<!-- Add Profile Image -->
<div class="modal fade" id="uploadProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light text-uppercase" id="exampleModalLabel">
                    upload profile image
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="save_img" autocomplete="off">
                <div class="modal-body text-dark">
                    
                    <!-- Profile Preview --> 
                    <div id="preview"></div>

                    <input type="hidden" name="faculty_id" id="faculty_id_e" >

                    <div class="form-group">
                        <label for="image">Upload Image</label>
                        <input type="file" class="form-control-file border rounded" id="image" name="image" accept=".png, .jpg">
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

<!-- Edit User Information -->

<div class="modal fade" id="editFacultyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light text-uppercase" id="exampleModalLabel">
                    edit faculty account
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update_faculty" autocomplete="off">
                <div class="modal-body text-dark">
                    
                    <input type="hidden" name="faculty_id" id="faculty_id_ee" >

                    <div class="row">

                        <!-- row 1 -->
                        <div class="col-md-6">
                            <div class="mt-2 mb-3">
                                <label for="title">Honorifics:</label>
                                <select class="form-control" name="honorifics" id="honorifics_e" required>
                                    <option selected disabled>--- Select ---</option>
                                    <option value="Mr.">Mr.</option>
                                    <option value="Ms.">Ms.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Dr.">Dr.</option>
                                    <option value="Engr.">Engr.</option>
                                </select>
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
                            <div class="mb-3">
                                <label for="">Gender</label>
                                <select class="form-control" name="gender" id="gender_e" required>
                                  <option selected>--- Select ---</option>
                                  <option value="Male"> Male </option>
                                  <option value="Female"> Female </option>
                                </select>
                            </div>
                        </div>

                        <!-- row 2 -->
                        <div class="col-md-6">
                            <div class="mt-2 mb-3">
                                <label for="">Birthdate:</label>
                                <input type="date" name="birthdate" id="birthdate_e" class="form-control" placeholder="mm/dd/yyyy"  id="birthdate" required>
                            </div>
                            <div class="mb-3">
                                <label for="title2">Title:</label>
                                <input type="text" name="title" id="title_e" class="form-control" onkeyup="lettersonlyTitle(this)">
                            </div>
                            <div class="mb-3">
                                <label for="position">Position:</label>
                                <select class="form-control" name="position" id="position_e" required>
                                    <option selected disabled>--- Select ---</option>
                                    <option value="Part Time Instructor">Part Time Instructor</option>
                                    <option value="Instructor I">Instructor I</option>
                                    <option value="Instructor II">Instructor II</option>
                                    <option value="Instructor III">Instructor III</option>
                                    <option value="Assistant Professor I">Assistant Professor I</option>
                                    <option value="Assistant Professor II">Assistant Professor II</option>
                                    <option value="Assistant Professor III">Assistant Professor III</option>
                                    <option value="Assistant Professor IV">Assistant Professor IV</option>
                                    <option value="Associate Prof I">Associate Prof I</option>
                                    <option value="Associate Prof II">Associate Prof II</option>
                                    <option value="Associate Prof III">Associate Prof III</option>
                                    <option value="Associate Prof IV">Associate Prof IV</option>
                                    <option value="Associate Prof V">Associate Prof V</option>
                                    <option value="Professor I">Professor I</option>
                                    <option value="Principal">Principal</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Username:</label>
                                <input type="text" name="username" id="username_e" class="form-control" onkeyup="lettersonly(this)" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Email:</label>
                                <input type="email" name="email" id="email_e" class="form-control" onkeyup="lettersonly(this)" required>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                    <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change User Password -->

<div class="modal fade" id="changePassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light text-uppercase" id="exampleModalLabel">
                    change password
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updatePassword" autocomplete="off">
                <div class="modal-body text-dark">

                    <input type="hidden" name="faculty_id" id="faculty_id_eee" readonly>

                    <div class="mt-2 mb-3">
                        <label for="">Old Password</label>
                        <input type="password" name="password" class="form-control" minlength="" pattern="^\S*$" required>
                    </div>
                    <div class="mb-3">
                        <label for="">New Password</label>
                        <input type="password" name="npassword" class="form-control" minlength="6" pattern="^\S*$" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Confirm New Password</label>
                        <input type="password" name="cnpassword" class="form-control" minlength="6" pattern="^\S*$" required>
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