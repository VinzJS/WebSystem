<?php

include_once 'C:\web\Xampp\htdocs\MainFolder(1)\user-main\config\config.php';
include_once 'C:\web\Xampp\htdocs\MainFolder(1)\log-in\login-user.php';

$user = new User();

if (isset($_REQUEST['submit'])) {
    extract($_REQUEST);
    $login = $user->check_login($useremail, $password);
    if ($login) {
        header("location: /MainFolder(1)/index.php?page=homepage");
        exit();
    } else {
        $error_message = "Wrong email or password.";
    }
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="stylesheets.css">
  </head>
  <body>
    <div class="login-box">
      <h1>Login</h1>
      <?php if (isset($error_message)) { ?>
        <div id="error_notif"><?php echo $error_message; ?></div>
      <?php } ?>
      <form method="POST" action="" name="login">
        <label for="username">Username:</label>
        <input type="email" class="input" required name="useremail" placeholder="Valid E-Mail" required>
        <label for="password">Password:</label>
        <input type="password" class="input" id="password" required name="password" placeholder="Enter password" required>
        <button type="submit" name="submit" value="submit">Login</button>
      </form>
    </div>
  </body>
</html>
