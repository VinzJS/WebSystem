<?php
include_once 'config-log.php';
include_once 'login-user.php';

$user = new User();

if(isset($_REQUEST['submit'])){
	extract($_REQUEST);
	$login = $user->check_login($useremail,$password);
	if($login){
		header("location: ../index.php");
	}else{
		?>
        <div id='error_notif'>Wrong email or password.</div>
        <?php
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
      <form method = "POST" action = "" name="login">
        <label for="username">Username:</label>
        <input type="email"  class = "input" required name="useremail" placeholder="Valid E-Mail" required>
        <label for="password">Password:</label>
        <input type="password" class = "input" id="password" required name="password" placeholder="Enter password" required>
        <button type="submit" name ="submit" value = "Submit">Login</button>
      </form>
    </div>
  </body>
</html>