<span id = "search-result">
<div id="subcontent">
        <a class = "add" href="index.php?page=user&subpage=taxiview&action=add_taxi">+ Add Taxi</a>
</div>

<h3>Taxi List</h3>
<div id="subcontent">
    <table id="data-list">
      <tr>
        <th>Taxi #</th>
        <th>Plate Number</th>
        <th>Model</th>
        <th>Car Type</th>
        <th>Car Capacity</th>
        <th>Transmission</th>
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
        <td><a href="index.php?page=user&subpage=taxiview&action=update_taxi&id=<?php echo $taxi_id;?>"><?php echo $taxi_plate;?></a></td>
        <td><?php echo $taxi_model;?></td>
        <td><?php echo $taxi_type;?></td>
        <td><?php echo $taxi_capacity;?></td>
        <td><?php echo $taxi_transmission;?></td>
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