                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Users
                                            </div>
                                                <?php

                                                    $sql = "SELECT * FROM tbl_faculty WHERE status = 1";
                                                    $result = $connect->query($sql);
                                                    $faculty = mysqli_num_rows($result);

                                                  ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $faculty; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Students
                                            </div>
                                                <?php

                                                    $sql = "SELECT * FROM tbl_student WHERE status = 1";
                                                    $result = $connect->query($sql);
                                                    $student = mysqli_num_rows($result);

                                                ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $student; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Total Male Students</div>
                                                <?php

                                                    $sql = "SELECT * FROM tbl_student WHERE gender = 'male' AND status = 1";
                                                    $result = $connect->query($sql);
                                                    $student_m = mysqli_num_rows($result);

                                                ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $student_m; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-mars fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Total Female Students</div>
                                                <?php

                                                    $sql = "SELECT * FROM tbl_student WHERE gender = 'female' AND status = 1";
                                                    $result = $connect->query($sql);
                                                    $student_f = mysqli_num_rows($result);

                                                ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $student_f; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-venus fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->