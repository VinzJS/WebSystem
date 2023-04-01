

<h3>Receive Transaction</h3>
<div id="receive-details">
  <?php $customer = new customer();
  ?>
  <table>
    <tr>
      <td><label for="recdate">Receive Date</label></td>
      <td class="info-text"><?php echo $customer->get_customer_first($id);?></td>
      <td><label for="purfrom">Purchased From</label></td>
      <td class="info-text"><?php echo $customer->get_customer_last($id);?></td>
    </tr>
    <tr>
      <td><label for="recamount">Amount</label></td>
      <td class="info-text"><?php echo $customer->get_customer_add($id);?></td>
      <td><label for="recamount">Phone</label></td>
      <td class="info-text"><?php echo $customer->get_customer_phone($id);?></td>
      
      
      </td>
    </tr>
  </table>

</div>
