<h3>Edit Information</h3>
<div id="form-block">
<?php
$taxi = new taxi();
$user = new User();

if ($user->get_session()) {
    $user_id = $user->get_user_id($_SESSION['user_email']);
    $user_access = $user->get_user_access($user_id);

    if ($user_access == "Staff") {
        echo "You do not have permission to update taxi information.";
    } else {
        $plate = $taxi->get_taxi_plate($id);
        $tid = $taxi->get_taxi_id($plate); // Move this line outside of the if statement

        ?>
        <form method="POST" action="taxi-crud/process-taxi/process.taxi.php?action=update_taxi">
            <div id="form-block-center">
                <input type="text" name="taxid" id="taxid" value="<?php echo $tid; ?>" readonly>

                <label for="plate"><br>Taxi Plate</br></label>
                <input type="text" id="plate" class="input" name="plate" value="<?php echo $taxi->get_taxi_plate($id)?>">

                <label for="model">Taxi Model</label>
                <input id="model" class="input" name="model" value="<?php echo $taxi->get_taxi_model($id)?>">
                
                <label for="type">Taxi Type</label>
                <input type="text" id="type" class="input" name="type" value="<?php echo $taxi->get_taxi_type($id)?>" />

                <label for="capacity">Car Capacity</label>
                <input type="text" id="capacity" class="input" name="capacity" value="<?php echo $taxi->get_taxi_capacity($id)?>"/>

                <label for="transmission">Transmission</label>
                <input type="text" id="transmission" class="input" name="transmission" value="<?php echo $taxi->get_taxi_transmission($id)?>"/>

            </div>
            <div id="button-block">
                <input type="submit" value="Save">
            </div>
        </form>
        <form method="POST" action="taxi-crud/process-taxi/process.taxi.php?action=delete_taxi" id="delete-form">
            <input type="hidden" name="action" value="delete_taxi">
            <input type="hidden" name="taxi_id" value="<?php echo $tid; ?>">
            <button type="button" class="delete" onclick="confirmDelete()">Delete Taxi</button>
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
    if (confirm("Are you sure you want to delete this Taxi?")) {
        document.getElementById("delete-form").submit();
    }
}
</script>
