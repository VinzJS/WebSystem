<h3>Provide the Required Information</h3>
<div id="form-block">
    <form method="POST" action="customer-crud/process-customer/process.customer.php?action=add_customer">
        <div id="form-block-center">
            <label for="cfirst">First Name</label>
            <input type="text" id="cfirst" class="input" name="cfirst" placeholder = "Insert Customer First Name">

            <label for="clast">Last Name</label>
            <textarea id="clast" class="input" name="clast" placeholder="Insert Customer Last Name"></textarea>
            
            <label for="phone">Customer Phone #</label>
            <input type="text"id="phone" class="input" name="phone" placeholder="Insert Phone #" />

            <label for="caddress">Customer Address</label>
            <input type="text"id="caddress" class="input" name="caddress" placeholder="Insert Address"/>

        
              </div>
        <div id="button-block">
        <input type="submit" value="Save">
        </div>
  </form>
</div>