
<h3>Fill up the required information</h3>
<div id="form-block">
    <form class = "test" method="POST" action="user-main/process-user/process-user.php?action=new">
        <div id="form-block-half">
            <label for="fname">First Name</label>
            <input type="text" id="fname" class="input" name="firstname" placeholder="Your name.." required>

            <label for="lname">Last Name</label>
            <input type="text" id="lname" class="input" name="lastname" placeholder="Your last name.." required>

            <label for = "access">User Access</label>
            <select  id = "access"  class = "input" name = "access">
            <option value = "Owner">Owner</option>
            <option value = "Staff">Staff</option>
        </select>

        </div>
        <div id="form-block-half">
            <label for="email">Email</label>
            <input type="email" id="email" class="input" name="email" placeholder="Your email.." required>

            <label for="password">Password</label>
            <input type="password" id="password" class="input" name="password" placeholder="Enter password.." pattern=".{8,}" title="Password must be at least 8 characters long" required>

            <label for="confirmpassword">Confirm Password</label>
            <input type="password" id="confirmpassword" class="input" name="confirmpassword" placeholder="Confirm password.." required>

<script>
    var password = document.getElementById("password");
    var confirmPassword = document.getElementById("confirmpassword");

    function validatePassword() {
        if (password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity("Passwords do not match");
        } else {
            confirmPassword.setCustomValidity("");
        }
    }

    password.onchange = validatePassword;
    confirmPassword.onkeyup = validatePassword;
</script>
            
        </div>
        <div id="button-block">
        <input type="submit" value="Save">
        </div>
  </form>
</div>
