<h3>Provide the Required Information</h3>
<div id="form-block">
    <?php 
    $taxi = new taxi();
    $customer = new customer();
    $booking = new booking();
    $user = new User();

    if ($user->get_session()) {
        $user_id = $user->get_user_id($_SESSION['user_email']);
        $user_access = $user->get_user_access($user_id);

        if ($user_access == "Staff") {
            echo "You do not have permission to update booking information.";
        } else {
            ?>
            <form method="POST" action="booking-crud/process-booking/process.booking.php?action=update_booking">
                <div id="form-block-center">
                    <input type="text" name="book_id" value="<?php echo $booking->get_book_id($id); ?>" readonly>

                    <label for="bookdate">Date</label>
                    <input type="date" id="bookdate" class="input" name="bookdate" value="<?php echo $booking->get_date($id) ?>">

                    <label for="price">Price Amount</label>
                    <input type="text" id="price" class="input" name="price" value="<?php echo $booking->get_price($id) ?>">

                    <label for="customer_first">Select Customer</label>
                    <select id="customer_first" name="customer_first" value="<?php echo $customer->get_customer_first($id) ?>">
                        <?php
                        $customer = new customer();
                        if ($customer->list_customer() != false) {
                            foreach ($customer->list_customer() as $value) {
                                extract($value);
                                ?>
                                <option value="<?php echo $customer_first; ?>"><?php echo $customer_id . "-" . $customer_first; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>

                    <label for="tid">Select Car Model</label>
                    <select id="tid" name="tid">
                        <?php
                        $taxi = new taxi();
                        if ($taxi->list_taxi() != false) {
                            foreach ($taxi->list_taxi() as $value) {
                                extract($value);
                                ?>
                                <option value="<?php echo $taxi_model; ?>"><?php echo $taxi_id . "-" . $taxi_model; ?></option>
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
            <form method="POST" action="booking-crud/process-booking/process.booking.php?action=delete_booking" id="delete-form">
                <input type="hidden" name="action" value="delete_booking">
                <input type="text" name="book_id" value="<?php echo $booking->get_book_id($id); ?>">
                <button type="button" class="delete" onclick="confirmDelete()">Delete Booking</button>
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
    if (confirm("Are you sure you want to delete this book?")) {
        document.getElementById("delete-form").submit();
    }
}
</script>
