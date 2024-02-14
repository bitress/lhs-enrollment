<!-- Add Faculty -->
<div class="modal fade" id="addFacultyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light text-uppercase" id="exampleModalLabel">
                    register faculty account
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="save_faculty" autocomplete="off">
                <div class="modal-body text-dark">
                    
                    <div class="row">

                        <!-- row 1 -->
                        <div class="col-md-6">
                            <div class="mt-2 mb-3">
                                <label for="title">Honorifics:</label>
                                <select class="form-control" name="honorifics" id="honorifics" required>
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

                        <!-- row 2 -->
                        <div class="col-md-6">
                            <div class="mt-2 mb-3">
                                <label for="title2">Title:</label>
                                <input type="text" name="title" id="title" class="form-control" onkeyup="lettersonlyTitle(this)">
                            </div>
                            <div class="mb-3">
                                <label for="position">Position:</label>
                                <select class="form-control" name="position" id="position" required>
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
                                <input type="text" name="username" class="form-control" onkeyup="lettersonly(this)" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Email:</label>
                                <input type="email" name="email" class="form-control" onkeyup="lettersonly(this)" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" minlength="6" pattern="^\S*$" required>
                            </div>
                            <div class="mb-3">
                                <label for="">User Type</label>
                                <select class="form-control" name="userType" required>
                                  <option selected disabled>--- Select ---</option>
                                  <option value="admin"> Admin </option>
                                  <option value="faculty"> Faculty </option>
                                  <option value="adviser"> Adviser </option>
                                </select>
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
                    
                    <input type="hidden" name="faculty_id" id="faculty_id_e" >

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
                            <div class="mb-3">
                                <label for="">Birthdate:</label>
                                <input type="date" name="birthdate" id="birthdate_e" class="form-control" placeholder="mm/dd/yyyy"  id="birthdate" required>
                            </div>
                        </div>

                        <!-- row 2 -->
                        <div class="col-md-6">
                            <div class="mt-2 mb-3">
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
                            <div class="mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" id="password_e" class="form-control" minlength="6" pattern="^\S*$" required>
                            </div>
                            <div class="mb-3">
                                <label for="">User Type</label>
                                <select class="form-control" name="userType" id="userType_e" required>
                                  <option selected disabled>--- Select ---</option>
                                  <option value="admin"> Admin </option>
                                  <option value="faculty"> Faculty </option>
                                  <option value="adviser"> Adviser </option>
                                </select>
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
<div class="modal fade" id="viewFacultyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light text-uppercase" id="exampleModalLabel">
                    view faculty account information
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update_faculty" autocomplete="off">
                <div class="modal-body text-dark">
                    
                    <input type="hidden" name="faculty_id" id="faculty_id_e" >

                    <div class="row">

                        <!-- row 1 -->
                        <div class="col-md-6">
                            <div class="mt-2 mb-3">
                                <label for="title">Honorifics:</label>
                                <select class="form-control" name="honorifics" id="honorifics_v" disabled>
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

                        <!-- row 2 -->
                        <div class="col-md-6">
                            <div class="mt-2 mb-3">
                                <label for="title2">Title:</label>
                                <input type="text" name="title" id="title_v" class="form-control" onkeyup="lettersonlyTitle(this)" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="position">Position:</label>
                                <select class="form-control" name="position" id="position_v" disabled>
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
                                <input type="text" name="username" id="username_v" class="form-control" onkeyup="lettersonly(this)" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="">Email:</label>
                                <input type="email" name="email" id="email_v" class="form-control" onkeyup="lettersonly(this)" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" id="password_v" class="form-control" minlength="6" pattern="^\S*$" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="">User Type</label>
                                <select class="form-control" name="userType" id="userType_v" disabled>
                                  <option selected disabled>--- Select ---</option>
                                  <option value="admin"> Admin </option>
                                  <option value="faculty"> Faculty </option>
                                  <option value="adviser"> Adviser </option>
                                </select>
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