<span id = "search-result">
<div id = "subcontent">
        <a class = "add" href="index.php?page=booking&subpage=bookingview&action=new_booking">+ New Booking</a>
</div>



<h3>Booking List</h3>
<div id="subcontent">
    <table id="data-list">
      <tr>
        <th>Booking ID</th>
        <th>Taxi ID/Model</th>
        <th>Customer Name</th>
        <th>Date</th>
        <th>Price</th>
      </tr>
<?php
$count = 1;
$count = 1;
$booking = new booking();
$customer = new customer();
$taxi = new taxi();
     if($booking->list_booking() != false){
         foreach($booking -> list_booking() as $value){
             extract($value);
             ?>
             <tr>
               <td><?php echo $count;?></a></td>
               <td><a href="index.php?page=user&subpage=bookingview&action=update_booking&id=<?php echo $booking_id?>"><?php echo $taxi_model;?></a></td>
               <td><?php echo $customer_first; ?></td>
               <td><?php echo $booking_date;?></td>
               <td><?php echo $booking_price;?></td>
             </tr>
             <tr>
 <?php
  $count++;      
 }     
}else{
    echo "No Record Found.";
  }

?>
    </table>
</div>
</span>