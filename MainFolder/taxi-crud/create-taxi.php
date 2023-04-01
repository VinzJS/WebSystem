<h3>Provide the Required Information</h3>
<div id="form-block">
    <form method="POST" action="taxi-crud/process-taxi/process.taxi.php?action=add_taxi">
        <div id="form-block-center">
            <label for="plate">Taxi Plate</label>
            <input type="text" id="plate" class="input" name="plate" placeholder = "Insert Plate Number">

            <label for="model">Taxi Model</label>
            <textarea id="model" class="input" name="model" placeholder="Insert Taxi Model"></textarea>
            
            <label for="type">Taxi Type</label>
            <input type="text"id="type" class="input" name="type" placeholder="Insert Taxi Type" />

            <label for="capacity">Car Capacity</label>
            <input type="text"id="capacity" class="input" name="capacity" placeholder="Insert Taxi Capacity"/>

            <label for="transmission">Transmission</label>
            <input type="text"id="transmission" class="input" name="transmission" placeholder="Insert Taxi Transmission"/>

            <label for="status">Status</label>
            <select id = "status" name = "status">
              <option id = "status">Available</option>
              <option id = "status">Unavailable</option>
            </select>
        
              </div>
        <div id="button-block">
        <input type="submit" value="Save">
        </div>
  </form>
</div>