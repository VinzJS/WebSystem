<?php
include_once '../classes/class.taxi.php';

$taxi = new taxi();

// get the q parameter from URL
$q = $_GET["q"];
$count = 1;
$hint = '<h3>Search Result(s)</h3>
  <div id="subcontent">
  <table id="data-list">
    <tr>
      <th>Taxi #</th>
      <th>Plate Number</th>
      <th>Model</th>
      <th>Car Type</th>
      <th>Car Capacity</th>
      <th>Transmission</th>
      <th>Status</th>
    </tr>';

$data = $taxi->list_taxi_search($q);
if ($data != false) {
  foreach ($data as $value) {
    extract($value);

    $hint .= '
    <tr>
      <td>'.$count.'</td>
      <td><a href="index.php?page=user&subpage=taxiview&action=update_taxi&id='.$taxi_id.'">'.$taxi_plate.'</a></td>
      <td>'.$taxi_model.'</td>
      <td>'.$taxi_type.'</td>
      <td>'.$taxi_capacity.'</td>
      <td>'.$taxi_transmission.'</td>
      <td>'.$taxi_status.'</td>
    </tr>';
    $count++;
  }
}

$hint .= '</table></div>';


  // Output "no suggestion" if no hint was found or output correct values
  echo $hint === "" ? "No result(s)" : $hint;
  ?>