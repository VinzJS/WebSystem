<link rel="stylesheet" href="stylesheets1.css">

<div id="form-block">
    <?php
    $user = new User();
    $email = $user->get_user_email($id);
    $user_id = $user->get_user_id($email);

    if ($user->get_session()) {
        $user_id = $user->get_user_id($_SESSION['user_email']);
        $user_access = $user->get_user_access($user_id);

        // Check if the user has "Staff" access, if yes, display a message and do not show the form
        if ($user_access == "Staff") {
            echo "You do not have permission to update user information.";
        } else {
            // User has permission to update, display the form
            ?>
            <form method="POST" action="user-main/process-user/process-user.php?action=update">
                <div id="form-block-center">
                    <input type="text" name="id" value="<?php echo $user->get_user_id($email); ?>" readonly>
                    <label for="cfirst"><br>First Name</br></label>
                    <input type="text" id="cfirst" class="input" name="firstname" value='<?php echo $user->get_user_firstname($id); ?>'>

                    <label for="clast">Last Name</label>
                    <input type="text" id="clast" class="input" name="lastname" value='<?php echo $user->get_user_lastname($id); ?>'>

                    <label for="email">Email</label>
                    <input type="email" id="email" class="input" name="email" value='<?php echo $user->get_user_email($id); ?>'>

                    <label for="access">User Access</label>
                    <select id="access" class="input" name="access">
                        <option value="Owner" <?php if ($user->get_user_access($id) == "Owner") {
                            echo "selected";
                        }; ?>>Owner</option>
                        <option value="Staff" <?php if ($user->get_user_access($id) == "Staff") {
                            echo "selected";
                        }; ?>>Staff</option>
                    </select>
                </div>
                <div id="button-block">
                    <input type="submit" value="Save">
                </div>
            </form>
            <form method="POST" action="user-main/process-user/process-user.php?action=delete_user" id="delete-form">
                <input type="hidden" name="action" value="delete_user">
                <input type="text" name="user_id" value="<?php echo $user->get_user_id($email); ?>">
                <button type="button" class="delete" onclick="confirmDelete()">Delete User</button>
            </form>

            <script>
                function confirmDelete() {
                    if (confirm("Are you sure you want to delete this user?")) {
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


<script>
function confirmDelete() {
    if (confirm("Are you sure you want to delete this user?")) {
        document.getElementById("delete-form").submit();
    }
}
</script>