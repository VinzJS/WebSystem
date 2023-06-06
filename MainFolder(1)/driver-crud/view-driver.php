<h3>Provide the Required Information</h3>
<div id="form-block">
<?php
$driver = new driver();
$user = new User();

if ($user->get_session()) {
    $user_id = $user->get_user_id($_SESSION['user_email']);
    $user_access = $user->get_user_access($user_id);

    if ($user_access == "Staff") {
        echo "You do not have permission to update driver information.";
    } else {
        ?>
        <form method="POST" action="driver-crud/process-driver/process.driver.php?action=update_driver">
            <div id="form-block-center">

            <?php
                $dr_last = $driver->get_lname($id);
                $driver_id = $driver->get_driver_id($dr_last);
            ?>
                <input type="text" name="id" value="<?php echo $driver->get_driver_id($dr_last); ?>" readonly>

                <label for="fname">First Name</label>
                <input type="text" id="fname" class="input" name="fname" value="<?php echo $driver->get_fname($id)?>">

                <label for="lname">Last Name</label>
                <input id="lname" class="input" name="lname" value="<?php echo $driver->get_lname($id)?>">
                
                <label for="dob">Date Of Birth</label>
                <input type="date" id="dob" class="input" name="dob" value="<?php echo $driver->get_dob($id)?>">

                <label for="age">Age</label>
                <input type="age" id="age" class="input" name="age" value="<?php echo $driver->get_age($id)?>">

                <label for="gender">Gender</label>
                <input type="text" id="gender" class="input" name="gender" value="<?php echo $driver->get_gender($id)?>">

                <label for="exp">License Expire Date</label>
                <input type="date" id="exp" class="input" name="exp" value="<?php echo $driver->get_exp($id)?>">
            
            </div>
            <div id="button-block">
                <input type="submit" value="Save">
            </div>
        </form>
        <form method="POST" action="driver-crud/process-driver/process.driver.php?action=delete_driver" id="delete-form">
            <input type="hidden" name="action" value="delete_driver">
            <input type="hidden" name="driver_id" value="<?php echo $driver_id; ?>">
            <button type="button" class="delete" onclick="confirmDelete()">Delete Driver</button>
        </form>

        <script>
        function confirmDelete() {
            if (confirm("Are you sure you want to delete this driver?")) {
                document.getElementById("delete-form").submit();
            }
        }
        </script>
    <?php
    }
} else {
    echo "User information not available.";
}
?>
</div>
