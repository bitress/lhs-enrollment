<?php  
  
    session_start();
    include 'connect.php';

    if (isset($_SESSION['username'])) {
    }
    else{

      header("location: login.php");
      
    }
    
    include 'include/topSection.php';

?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'include/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'include/topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <?php include 'include/widget.php'; ?>
                    <?php include 'include/charts.php'; ?>

                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'include/footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Profile Settings Modal-->
    <?php include 'include/profile_settings.php'; ?>

    <!-- Logout Modal-->
    <?php include 'include/logout.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>

    <?php

      $query1 = $connect->query("SELECT t2.grade_level AS grade_level, COUNT(t1.enrollment_id) AS total, t3.* 
                FROM tbl_enrollment AS t1 
                INNER JOIN tbl_grade_level AS t2 ON t1.grade_level_id = t2.grade_level_id
                INNER JOIN tbl_sy AS t3 ON t1.sy_id = t3.sy_id
                WHERE t3.sy_status = 1
                GROUP BY t2.grade_level");

      foreach($query1 as $data1)
      {
        $grade_level[] = $data1['grade_level'];
        $total[] = $data1['total'];
      }

    ?>

    <script>
    var ctx = document.getElementById('linechart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($grade_level) ?>,
            datasets: [{
                label: 'Number of Students',
                data: <?php echo json_encode($total) ?>,
                backgroundColor: [
                    'rgb(37, 150, 222)'
                ],
                borderColor: [
                    'rgb(6, 127, 210)'
                ],
                borderWidth: 3
            }]
        },
        options: {
          responsive: true
        }
    });
    </script>
    
<!-- Bottom Section-->
<?php include 'include/botSection.php'; ?>