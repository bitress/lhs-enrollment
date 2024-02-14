                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <?php
                                if(isset($_SESSION['faculty_id'])){
                                    $faculty = $_SESSION['faculty_id'];
                                    $query = "SELECT * FROM tbl_faculty WHERE faculty_id = '$faculty'";
                                    $result =mysqli_query($connect,$query);
                                    while($row =mysqli_fetch_array($result)) {
                            ?>
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small text-uppercase">
                                    <?php echo $row['username'] ?> 
                                </span>
                                <?php if($row['image'] != NULL) { ?>
                                    <img class="img-profile rounded-circle" src="profile_image/<?php echo $row['image'] ?> ">
                                <?php } else { ?>
                                    <img class="img-profile rounded-circle" src="img/default_profile.jpg">
                                <?php } ?>
                            </a>
                            <?php
                                    }
                                }
                            ?>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="account_settings.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile Settings
                                </a>
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->