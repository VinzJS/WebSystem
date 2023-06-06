<?php 
include_once 'C:\web\Xampp\htdocs\MainFolder(1)\classes\class.booking.php';
$booking = new booking();


// get the q parameter from URL
$q = $_GET["q"];
$count = 1;
$hint = '<h3>Search Result(s)</h3>
  <div id="subcontent">
  <table id="data-list">
    <tr>
     <th>Booking ID</th>
     <th>Taxi ID/Model</th>
     <th>Customer Name</th>
     <th>Date</th>
     <th>Price</th>
    </tr>';

$data = $booking->list_booking_search($q);
if ($data != false) {
  foreach ($data as $value) {
    extract($value);

    $hint .= '
    <tr>
      <td>'.$count.'</td>
      <td><a href="index.php?page=user&subpage=bookingview&action=update_booking&id='.$booking_id.'">'.$taxi_model.'</a></td>
      <td>'.$customer_first.'</td>
      <td>'.$booking_date.'</td>
      <td>'.$booking_price.'</td>
    </tr>';
    $count++;
  }
}

$hint .= '</table></div>';


  // Output "no suggestion" if no hint was found or output correct values
  echo $hint === "" ? "No result(s)" : $hint;
  ?>