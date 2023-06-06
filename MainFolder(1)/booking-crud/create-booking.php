<h3>Provide the Required Information</h3>
<div id="form-block">
    <form method="POST" action="booking-crud/process-booking/process.booking.php?action=new_booking">
        <div id="form-block-center">
          
            <label for="bookdate">Date</label>
            <input type="date" id="bookdate" class="input" name="bookdate" placeholder="Enter Date." required>

            <label for="price">Price Amount</label>
            <textarea type = "text"id="price" class="input" name="price" placeholder="Enter amount." required></textarea>

            <label for="customer_first">Select Customer</label>
            <select id="customer_first" name="customer_first">
              <?php
              $customer = new customer();
              if($customer->list_customer() != false){
                foreach($customer ->list_customer() as $value){
                   extract($value);
              ?>
               <option value="<?php echo $customer_first;?>"><?php echo $customer_id. "-" .$customer_first;?></option>

              <?php
                }
              }
              ?>
        </select>
              </div>
            

            <label for="tid">Select Car Model</label>
            <select id="tid" name="tid">
              <?php
              $taxi = new taxi();
              if($taxi->list_taxi() != false){
                foreach($taxi ->list_taxi() as $value){
                   extract($value);
              ?>
               <option value="<?php echo $taxi_model;?>"><?php echo $taxi_id. "-" .$taxi_model;?></option>

              <?php
                }
              }
              ?>
        </select>
              </div>
        <div id="button-block">
        <input type="submit" value="Save">
        </div>
  </form>
</div>