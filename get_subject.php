<?php 

include 'connect.php';

$grade_level_id = $_POST['grade_level_section'];

$sql = "SELECT t2.offered_subject_id, t1.subject_name, t3.grade_level, t3.section, t4.*
FROM tbl_subject AS t1
INNER JOIN tbl_offered_subject AS t2 ON t2.subject_id = t1.subject_id
INNER JOIN tbl_grade_level AS t3 ON t3.grade_level_id = t2.grade_level_id
INNER JOIN tbl_faculty AS t4 ON t4.faculty_id = t2.faculty_id
WHERE t3.grade_level_id = '$grade_level_id'";

$result = mysqli_query($connect, $sql);
	if ($result = mysqli_query($connect, $sql)) {

		$rowCount = mysqli_num_rows($result);

		$result1 = $connect->query($sql);
		$up=0;
			if (mysqli_num_rows($result) > 0) {
				while ($row = $result1->fetch_assoc()) {
					$middle_name = substr($row["mname"], 0, 1);
					
					$up++;
					echo "<tr class='text-capitalize'>";
						echo '<td class="w-50">'.'<input type="hidden" value="'.$row["offered_subject_id"].'" name="offered_subject_id'.$up.'">'.$row['subject_name'].'</td>';
						echo "<td>".$row['grade_level']."</td>";
						echo "<td>".$row['section']."</td>";
						echo "<td>".$row['honorifics']." ".$row['fname']." ".$middle_name.". ".$row['lname']."</td>";
					echo "</tr>";

				}
			} else {
				echo "NO SUBJECT AVAILABLE";
			}

	} 

?>