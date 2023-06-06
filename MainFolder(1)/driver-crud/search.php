<?php
include_once '../classes/class.driver.php';

$driver = new driver();

// get the q parameter from URL
$q = $_GET["q"];
$count = 1;
$hint = '<h3>Search Result(s)</h3>
  <div id="subcontent">
  <table id="data-list">
    <tr>
      <th>Driver #</th>
      <th>Driver Name</th>
      <th>Birth Date</th>
      <th>Age</th>
      <th>Gender</th>
      <th>Drivers License Expire Date</th>
    </tr>';

$data = $driver->list_driver_search($q);
if ($data != false) {
  foreach ($data as $value) {
    extract($value);

    $hint .= '
    <tr>
      <td>'.$count.'</td>
      <td><a href="index.php?page=user&subpage=driverview&action=update_driver&id='.$driver_id.'">'.$dr_first.', '.$dr_last.'</a></td>
      <td>'.$dr_dob.'</td>
      <td>'.$dr_age.'</td>
      <td>'.$dr_gender.'</td>
      <td>'.$dr_exp.'</td>
    </tr>';
    $count++;
  }
}

$hint .= '</table></div>';


  // Output "no suggestion" if no hint was found or output correct values
  echo $hint === "" ? "No result(s)" : $hint;
  ?>