
<div id="subcontent">
        <a class = "add" href="index.php?page=user&subpage=cview&action=add_customer">+ Add Customer</a>
</div>

<h3>Drivers List</h3>
<div id="subcontent">
    <table id="data-list">
      <tr>
        <th>Customer #</th>
        <th>Customer Name</th>
        <th>Phone Number</th>
        <th>Address</th>
      </tr>
<?php
$count = 1;
$count = 1;
$customer = new customer();
if($customer->list_customer() != false){
foreach($customer->list_customer() as $value){
   extract($value);
  
?>
      <tr>
        <td><?php echo $count;?></td>
        <td><a href="index.php?page=user&subpage=cview&action=update&id=<?php echo $customer_id;?>"><?php echo $customer_first. "," .$customer_last;?></a></td>
        <td><?php echo $customer_phone;?></td>
        <td><?php echo $customer_add;?></td>

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