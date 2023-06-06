<?php
$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
$subpage = (isset($_GET['subpage']) && $_GET['subpage'] != '') ? $_GET['subpage'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';

include_once 'C:\web\Xampp\htdocs\MainFolder(1)\user-main\config\config.php';
include_once 'C:\web\Xampp\htdocs\MainFolder(1)\classes\user-class.php';
$user = new User();

// Check if the user is logged in and retrieve their information
if ($user->get_session()) {
    $user_id = $user->get_user_id($_SESSION['user_email']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Website</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets1.css">
</head>
<body>
    <div class ="wrapper">
        <div class ="sidebar">
        <h2>User</h2>
            <ul>
                <li><a href="index.php?page=homepage">Home</a></li>
                <li><a href="index.php?page=user&subpage=cview">View Customer</a></li>
                <li><a href="index.php?page=user&subpage=taxiview">View Taxi</a></li>
                <li><a href="index.php?page=user&subpage=driverview">View Driver</a></li>
                <li><a href="index.php?page=user&subpage=view">View User</a></li>
                <li><a href="index.php?page=booking&subpage=bookingview">View Bookings</a></li>
            </ul>
        </div>
        <div class ="main_content"> 
        <div class = "header">Welcome! <?php echo $user->get_user_lastname($user_id) . ', ' . $user->get_user_firstname($user_id) . ' - ' .$user -> get_user_access($user_id); ?>
            <a class = "logout" href="log-in/logout.php">Log Out</a>
        </div>
        <?php
        switch($subpage){
                case 'view':
                    require_once 'user-main/user-module/index.php';
                break; 
                case 'driverview':
                    require_once 'driver-crud/index.php';
                break; 
                case 'taxiview':
                    require_once 'taxi-crud/index.php';
                break; 
                case 'bookingview':
                    require_once 'booking-crud/index.php';
                break; 
                case 'cview':
                    require_once 'customer-crud/index.php';
                break; 
                default:
                    require_once 'index.php';
                break; 
            }
        switch($page){
            case 'homepage':
                require_once 'dashboard.php';
            break;
         default:
         require_once 'index.php';
         break;
        }
         ?>
    </div>
</body>
</html>

