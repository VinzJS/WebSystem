<h3>Provide the Required Information</h3>
<div id="form-block">
    <form method="POST" action="driver-crud/process-driver/process.driver.php?action=add_driver">
        <div id="form-block-center">
            <label for="fname">First Name</label>
            <input type="text" id="fname" class="input" name="fname" placeholder = "First Name" required>

            <label for="lname">Last Name</label>
            <textarea id="lname" class="input" name="lname" placeholder="Last Name" required></textarea>
            
            <label for="dob">Date Of Birth</label>
            <input type="date"id="dob" class="input" name="dob"required />
            <label for="age">Age</label>
            <input type="age"id="age" class="input" name="age" required/>
            <label for="gender">Gender</label>
            <input type="text"id="gender" class="input" name="gender" required/>
            <label for="exp">License Expire Date</label>
            <input type="date"id="exp" class="input" name="exp" required/>
        
              </div>
        <div id="button-block">
        <input type="submit" value="Save">
        </div>
  </form>
</div>