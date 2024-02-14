<?php
    if($_SESSION['userType'] == "admin" || $_SESSION['userType'] == "co_admin"){
?>
            <!-- Sidebar - Brand -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-graduation-cap" style="font-size: 40px;"></i>
                </div>
                <div class="sidebar-brand-text mx-2" style="font-size: 10px;">LHS Enrollment System</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard - <?php if($_SESSION['userType'] == "admin"){
                    echo"ADMIN";} else if($_SESSION['userType'] == "co_admin"){echo"CO-ADMIN";} ?> </span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Fundamentals Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-star"></i>
                    <span>Fundamentals</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Components:</h6>
                        <a class="collapse-item" href="manage_faculty.php">
                            <i class="fas fa-user"></i> Faculty
                        </a>
                        <a class="collapse-item" href="manage_student.php">
                            <i class="fas fa-user"></i> Student
                        </a>
                        <a class="collapse-item" href="manage_subject.php">
                            <i class="fas fa-book"></i> Subject
                        </a>
                        <a class="collapse-item" href="manage_grade_level.php">
                            <i class="fas fa-award"></i> Grade Level
                        </a>
                        <a class="collapse-item" href="manage_sy.php">
                            <i class="fas fa-calendar"></i> School Year
                        </a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="manage_offered_subject.php">
                            <i class="fas fa-book"></i> Offered Subjects
                        </a>
                        <a class="collapse-item" href="manage_enrollment.php">
                            <i class="fas fa-file"></i> Enrollment
                        </a>
                       
                        <!-- <a class="collapse-item" href="manage_grade.php">
                            <i class="fas fa-award"></i> Students Grades
                        </a> -->
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <!--<hr class="sidebar-divider">-->

            <!-- Heading -->
            <!--<div class="sidebar-heading">
                Addons
            </div>-->

            <!-- Nav Item - Student Ranking -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="manage_students_ranking.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Student Ranking</span></a>
            </li> -->

            <!-- Nav Item - Attendance -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="manage_attendance.php">
                    <i class="fas fa-fw fa-clipboard"></i>
                    <span>Attendance</span></a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Bin
            </div>

            <!-- Nav Item - Archieved Data -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1"
                    aria-expanded="true" aria-controls="collapseUtilities1">
                    <i class="fas fa-fw fa-archive"></i>
                    <span>Archived Data</span>
                </a>
                <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Archived Data: </h6>
                        <a class="collapse-item" href="del_manageFaculty.php">
                            <i class="fas fa-users"></i> Faculty
                        </a>
                        <a class="collapse-item" href="del_manageStudent.php">
                            <i class="fas fa-users"></i> Student
                        </a>
                        <a class="collapse-item" href="del_manageSubject.php">
                            <i class="fas fa-book"></i> Subject
                        </a>
                        <a class="collapse-item" href="del_manageOfferedSubject.php">
                            <i class="fas fa-book"></i> Offered Subject
                        </a>
                        <!-- <a class="collapse-item" href="payment_history.php">
                            <i class="fas fa-book"></i> Payment History
                        </a> -->
                    </div>
                </div>
            </li>

            <!-- Nav Item - Tables -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-arrow-up"></i>
                    <span>Promoted Student</span></a>
            </li> -->

            <!-- Nav Item - Tables -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Reports</span></a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
<?php
    }

   else if($_SESSION['userType'] == "cashier"){
?>
            <!-- Sidebar - Brand -->
            <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-graduation-cap" style="font-size: 40px;"></i>
                </div>
                <div class="sidebar-brand-text mx-2" style="font-size: 10px;">LHS Enrollment System</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard - <?php if($_SESSION['userType'] == "cashier"){
                    echo"CASHIER";} ?> </span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            
            <!-- Nav Item - Student -->
           
            
            <!-- Nav Item - Enrollment -->
            <li class="nav-item">
                <a class="nav-link" href="manage_enrollment.php">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Enrollment</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manage_payments.php">
                    <i class="fas fa-fw fa-money-bill"></i>
                    <span>Payments</span></a>
            </li>
        <li class="nav-item">
        <a class="nav-link" href="manage_fee.php">
            <i class="fas fa-fw fa-file"></i>
            <span>Fees</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="payment_history.php">
                    <i class="fas fa-fw fa-money-bill"></i>
                    <span>Payment History</span></a>
            </li>

            <!-- Nav Item - Fundamentals Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-star"></i>
                    <span>Fundamentals</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Components:</h6>
                        <a class="collapse-item" href="manage_faculty.php">
                            <i class="fas fa-user"></i> Faculty
                        </a>
                        <a class="collapse-item" href="manage_student.php">
                            <i class="fas fa-user"></i> Student
                        </a>
                        <a class="collapse-item" href="manage_subject.php">
                            <i class="fas fa-book"></i> Subject
                        </a>
                        <a class="collapse-item" href="manage_grade_level.php">
                            <i class="fas fa-award"></i> Grade Level
                        </a>
                        <a class="collapse-item" href="manage_sy.php">
                            <i class="fas fa-calendar"></i> School Year
                        </a>
                    </div>
                </div>
            </li> -->

            <!-- Nav Item - Utilities Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="manage_offered_subject.php">
                            <i class="fas fa-book"></i> Offered Subjects
                        </a>
                        <a class="collapse-item" href="manage_enrollment.php">
                            <i class="fas fa-file"></i> Enrollment
                        </a>
                        <!-- <a class="collapse-item" href="manage_grade.php">
                            <i class="fas fa-award"></i> Students Grades
                        </a>
                    </div>
                </div>
            </li> -->

            <!-- Divider -->
            <!--<hr class="sidebar-divider">-->

            <!-- Heading -->
            <!--<div class="sidebar-heading">
                Addons
            </div>-->

            <!-- Nav Item - Student Ranking -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="manage_students_ranking.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Student Ranking</span></a>
            </li> -->

            <!-- Nav Item - Attendance -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="manage_attendance.php">
                    <i class="fas fa-fw fa-clipboard"></i>
                    <span>Attendance</span></a>
            </li> -->

            <!-- Divider -->
          

            <!-- Nav Item - Tables -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-arrow-up"></i>
                    <span>Promoted Student</span></a>
            </li> -->

            <!-- Nav Item - Tables -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Reports</span></a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
<?php
    }
?>