
<div id="subcontent">
        <a class = "add" href="index.php?page=user&subpage=driverview&action=add_driver">+ Add Driver</a>
</div>

<h3>Drivers List</h3>
<div id="subcontent">
    <table id="data-list">
      <tr>
        <th>Driver #</th>
        <th>Driver Name</th>
        <th>Birth Date</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Drivers License Expire Date</th>
      </tr>
<?php
$count = 1;
$count = 1;
$driver = new driver();
if($driver->list_driver() != false){
foreach($driver->list_driver() as $value){
   extract($value);
  
?>
      <tr>
        <td><?php echo $count;?></td>
        <td><a href="view-user.php?page=user&subpage=user&action=profile&id=<?php echo $driverid;?>"><?php echo $dr_last.', '.$dr_first;?></a></td>
        <td><?php echo $dr_dob;?></td>
        <td><?php echo $dr_age;?></td>
        <td><?php echo $dr_gender;?></td>
        <td><?php echo $dr_exp;?></td>
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