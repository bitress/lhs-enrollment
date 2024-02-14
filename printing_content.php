<?php 
include 'connect.php';
include 'include/topSection.php';
?>

<h1>hello world</h1>
<p><?=$row['enrollment_id']?></p>
<p><?=$row['fname']?></p>
<p><?=$row['mname']?></p>
<p><?=$row['lname']?></p>

<table class="table table-bordered" width="100%" border="1">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>

<!-- Bottom Section-->
<?php include 'include/botSection.php'; ?>