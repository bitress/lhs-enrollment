<?php 

include "connect.php";

$lrn = $_POST['lrn'];

$sql = "SELECT student_id, lrn FROM tbl_student WHERE student_id = $lrn";

$result = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_array($result)) {

?>

<label for="">LRN:</label>
<input type="text" class="form-control" name="lrn" value="<?php echo $row ['lrn']; ?>" disabled>

<?php
  
  }

?>