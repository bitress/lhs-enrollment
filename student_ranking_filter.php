<?php

    include "connect.php";

    if (isset($_POST['schoolyear']) && isset($_POST['gradelevel'])) {

    $gradelevel = $_POST['gradelevel'];
    $schoolyear = $_POST['schoolyear'];

?>

<div class="card">
    <div class="card-body">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="firstQ-tab" data-toggle="tab" href="#firstQ" role="tab" aria-controls="firstQ" aria-selected="true">1st Quarter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="secondQ-tab" data-toggle="tab" href="#secondQ" role="tab" aria-controls="secondQ" aria-selected="false">2nd Quarter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="thirdQ-tab" data-toggle="tab" href="#thirdQ" role="tab" aria-controls="thirdQ" aria-selected="false">3rd Quarter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="fourthQ-tab" data-toggle="tab" href="#fourthQ" role="tab" aria-controls="fourthQ" aria-selected="false">4th Quarter</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">

            <!-- First Quarter -->
            <div class="tab-pane fade show active" id="firstQ" role="tabpanel" aria-labelledby="firstQ-tab">
                <div class="card-body">
                    <table id="myTable1" class="table table-hover">
                        <thead class="" style="font-size: 15px;">
                            <tr>
                                <th class="text-center"> Student Name </th>
                                <th class="text-center"> Grade Level Section </th>
                                <th class="text-center"> First Quarter Average </th>
                                <th class="text-center"> RANK </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT t1.firstquarter_average, t1.fname, t1.lname, t1.mname, t1.extension, t1.grade_level_section, t1.sy,
                                    (
                                        SELECT COUNT(DISTINCT t2.firstquarter_average)
                                        FROM tbl_student_ranking AS t2
                                        WHERE t2.firstquarter_average >= t1.firstquarter_average AND t2.grade_level_id = '$gradelevel'
                                    ) AS 'RANK'
                                FROM tbl_student_ranking AS t1
                                WHERE t1.grade_level_id = '$gradelevel' AND t1.sy_id = '$schoolyear'
                                ORDER BY t1.firstquarter_average DESC";
                            $result =mysqli_query($connect,$query);
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                          <!-- Table Content -->
                          <tr class="text-capitalize text-center">
                              <td> <?php echo $row["fname"] ?> <?php echo substr($row["mname"], 0, 1); ?>. <?php echo $row["lname"] ?> <?php echo $row["extension"] ?> </td>
                              <td> <?php echo $row["grade_level_section"] ?> </td>
                              <td> <?php echo number_format($row["firstquarter_average"], 2, '.', ''); ?> </td>
                              <td> <?php echo $row["RANK"] ?> </td>
                          </tr>
                          <!-- End of Table Content -->
                        <?php  
                            }
                        ?>
                      </tbody>
                    </table>
                </div>
            </div>

            <!-- Second Quarter -->
            <div class="tab-pane fade" id="secondQ" role="tabpanel" aria-labelledby="secondQ-tab">
                <div class="card-body">
                    <table id="myTable2" class="table table-hover">
                        <thead class="" style="font-size: 15px;">
                            <tr>
                                <th class="text-center"> Student Name </th>
                                <th class="text-center"> Grade Level Section </th>
                                <th class="text-center"> Second Quarter Average </th>
                                <th class="text-center"> RANK </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT t1.secondquarter_average, t1.fname, t1.lname, t1.mname, t1.extension, t1.grade_level_section, t1.sy,
                                    (
                                        SELECT COUNT(DISTINCT t2.secondquarter_average)
                                        FROM tbl_student_ranking AS t2
                                        WHERE t2.secondquarter_average >= t1.secondquarter_average AND t2.grade_level_id = '$gradelevel'
                                    ) AS 'RANK'
                                FROM tbl_student_ranking AS t1
                                WHERE t1.grade_level_id = '$gradelevel' AND t1.sy_id = '$schoolyear'
                                ORDER BY t1.secondquarter_average DESC";
                            $result =mysqli_query($connect,$query);
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                          <!-- Table Content -->
                          <tr class="text-capitalize text-center">
                              <td> <?php echo $row["fname"] ?> <?php echo substr($row["mname"], 0, 1); ?>. <?php echo $row["lname"] ?> <?php echo $row["extension"] ?> </td>
                              <td> <?php echo $row["grade_level_section"] ?> </td>
                              <td> <?php echo number_format($row["secondquarter_average"], 2, '.', ''); ?> </td>
                              <td> <?php echo $row["RANK"] ?> </td>
                          </tr>
                          <!-- End of Table Content -->
                        <?php  
                            }
                        ?>
                      </tbody>
                    </table>
                </div>
            </div>

            <!-- Third Quarter -->
            <div class="tab-pane fade" id="thirdQ" role="tabpanel" aria-labelledby="thirdQ-tab">
                <div class="card-body">
                    <table id="myTable3" class="table table-hover">
                        <thead class="" style="font-size: 15px;">
                            <tr>
                                <th class="text-center"> Student Name </th>
                                <th class="text-center"> Grade Level Section </th>
                                <th class="text-center"> Third Quarter Average </th>
                                <th class="text-center"> RANK </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT t1.thirdquarter_average, t1.fname, t1.lname, t1.mname, t1.extension, t1.grade_level_section, t1.sy,
                                    (
                                        SELECT COUNT(DISTINCT t2.thirdquarter_average)
                                        FROM tbl_student_ranking AS t2
                                        WHERE t2.thirdquarter_average >= t1.thirdquarter_average AND t2.grade_level_id = '$gradelevel'
                                    ) AS 'RANK'
                                FROM tbl_student_ranking AS t1
                                WHERE t1.grade_level_id = '$gradelevel' AND t1.sy_id = '$schoolyear'
                                ORDER BY t1.thirdquarter_average DESC";
                            $result =mysqli_query($connect,$query);
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                          <!-- Table Content -->
                          <tr class="text-capitalize text-center">
                              <td> <?php echo $row["fname"] ?> <?php echo substr($row["mname"], 0, 1); ?>. <?php echo $row["lname"] ?> <?php echo $row["extension"] ?> </td>
                              <td> <?php echo $row["grade_level_section"] ?> </td>
                              <td> <?php echo number_format($row["thirdquarter_average"], 2, '.', ''); ?> </td>
                              <td> <?php echo $row["RANK"] ?> </td>
                          </tr>
                          <!-- End of Table Content -->
                        <?php  
                            }
                        ?>
                      </tbody>
                    </table>
                </div>
            </div>

            <!-- Fourth Quarter -->
            <div class="tab-pane fade" id="fourthQ" role="tabpanel" aria-labelledby="fourthQ-tab">
                <div class="card-body">
                    <table id="myTable4" class="table table-hover">
                        <thead class="" style="font-size: 15px;">
                            <tr>
                                <th class="text-center"> Student Name </th>
                                <th class="text-center"> Grade Level Section </th>
                                <th class="text-center"> Fourth Quarter Average </th>
                                <th class="text-center"> RANK </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT t1.fourthquarter_average, t1.fname, t1.lname, t1.mname, t1.extension, t1.grade_level_section, t1.sy,
                                    (
                                        SELECT COUNT(DISTINCT t2.fourthquarter_average)
                                        FROM tbl_student_ranking AS t2
                                        WHERE t2.fourthquarter_average >= t1.fourthquarter_average AND t2.grade_level_id = '$gradelevel'
                                    ) AS 'RANK'
                                FROM tbl_student_ranking AS t1
                                WHERE t1.grade_level_id = '$gradelevel' AND t1.sy_id = '$schoolyear'
                                ORDER BY t1.fourthquarter_average DESC";
                            $result =mysqli_query($connect,$query);
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                          <!-- Table Content -->
                          <tr class="text-capitalize text-center">
                              <td> <?php echo $row["fname"] ?> <?php echo substr($row["mname"], 0, 1); ?>. <?php echo $row["lname"] ?> <?php echo $row["extension"] ?> </td>
                              <td> <?php echo $row["grade_level_section"] ?> </td>
                              <td> <?php echo number_format($row["fourthquarter_average"], 2, '.', ''); ?> </td>
                              <td> <?php echo $row["RANK"] ?> </td>
                          </tr>
                          <!-- End of Table Content -->
                        <?php  
                            }
                        ?>
                      </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>

<?php
    }
?>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
//1st
$(document).ready(function () {

    $('#myTable1').DataTable({
        "ordering": false
    });

});
//2nd
$(document).ready(function () {

    $('#myTable2').DataTable({
        "ordering": false
    });

});
//3rd
$(document).ready(function () {

    $('#myTable3').DataTable({
        "ordering": false
    });

});
//4th
$(document).ready(function () {

    $('#myTable4').DataTable({
        "ordering": false
    });

});
</script>