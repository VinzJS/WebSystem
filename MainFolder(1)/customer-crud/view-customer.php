<h3>Provide the Required Information</h3>
<div id="form-block">
  <?php
  $customer = new customer();
  $user = new User();

  if ($user->get_session()) {
      $user_id = $user->get_user_id($_SESSION['user_email']);
      $user_access = $user->get_user_access($user_id);

      if ($user_access == "Staff") {
          echo "You do not have permission to update customer information.";
      } else {
          ?>
          <form method="POST" action="customer-crud/process-customer/process.customer.php?action=update_customer">
              <div id="form-block-center">
              <?php
                  $customer_first = $customer->get_customer_first($id);
                  $customer_id = $customer->get_customer_id($customer_first);
              ?>
                  <input type="text" name="id" value="<?php echo $customer->get_customer_id($customer_first); ?>" readonly>

                  <label for="cfirst"><br>First Name</br></label>
                  <input type="text" id="cfirst" class="input" name="cfirst" value="<?php echo $customer->get_customer_first($id) ?>">

                  <label for="clast">Last Name</label>
                  <input type="text" id="clast" class="input" name="clast" value="<?php echo $customer->get_customer_last($id) ?>">
                  
                  <label for="phone">Customer Phone #</label>
                  <input type="text" id="phone" class="input" name="phone" value="<?php echo $customer->get_customer_phone($id)?>" />

                  <label for="caddress">Customer Address</label>
                  <input type="text" id="caddress" class="input" name="caddress" value="<?php echo $customer->get_customer_add($id)?>"/>
              </div>
              <div id="button-block">
                  <input type="submit" value="Save">
              </div>
          </form>
          <form method="POST" action="customer-crud/process-customer/process.customer.php?action=delete_customer" id="delete-form">
              <input type="hidden" name="action" value="delete_customer">
              <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
              <button type="button" class="delete" onclick="confirmDelete()">Delete Customer</button>
          </form>
          <?php
      }
  } else {
      echo "User information not available.";
  }
  ?>
</div>

<script>
function confirmDelete() {
    if (confirm("Are you sure you want to delete this customer?")) {
        document.getElementById("delete-form").submit();
    }
}
</script>
