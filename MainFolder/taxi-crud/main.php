
<div id="subcontent">
        <a class = "add" href="index.php?page=user&subpage=taxiview&action=add_taxi">+ Add Taxi</a>
</div>

<h3>Drivers List</h3>
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
      </tr>
<?php
$count = 1;
$count = 1;
$taxi = new taxi();
if($taxi->list_taxi() != false){
foreach($taxi->list_taxi() as $value){
   extract($value);
  
?>
      <tr>
        <td><?php echo $count;?></td>
        <td><a href="view-user.php?page=user&subpage=user&action=profile&id=<?php echo $taxiid;?>"><?php echo $taxi_plate;?></a></td>
        <td><?php echo $taxi_model;?></td>
        <td><?php echo $taxi_type;?></td>
        <td><?php echo $taxi_capacity;?></td>
        <td><?php echo $taxi_transmission;?></td>
        <td><?php echo $taxi_status;?></td>
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