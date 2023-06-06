<?php
include_once '../classes/class.customer.php';

$customer = new customer();

// get the q parameter from URL
$q = $_GET["q"];
$count = 1;
$hint = '<h3>Search Result(s)</h3>
  <div id="subcontent">
  <table id="data-list">
    <tr>
      <th>Customer #</th>
      <th>Customer Name</th>
      <th>Phone Number</th>
      <th>Address</th>
    </tr>';

$data = $customer->list_customer_search($q);
if ($data != false) {
  foreach ($data as $value) {
    extract($value);

    $hint .= '
    <tr>
      <td>'.$count.'</td>
      <td><a href="index.php?page=user&subpage=cview&action=update_customer&id='.$customer_id.'">'.$customer_first.', '.$customer_last.'</a></td>
      <td>'.$customer_phone.'</td>
      <td>'.$customer_add.'</td>
    </tr>';
    $count++;
  }
}

$hint .= '</table></div>';


  // Output "no suggestion" if no hint was found or output correct values
  echo $hint === "" ? "No result(s)" : $hint;
  ?>