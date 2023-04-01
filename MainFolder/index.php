<?php
include 'user-main/config/config.php';
include 'user-main/user-module/user-class.php';


$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
$subpage = (isset($_GET['subpage']) && $_GET['subpage'] != '') ? $_GET['subpage'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';
$user = new User();

?>
<!DOCTYPE html>
<html>
<head>
    <title>My Website</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user-main/css/stylesheets1.css">
</head>
<body>
    <div class ="wrapper">
        <div class ="sidebar">
        <h2>User</h2>
            <ul>
                <li><a href="index.php?page=user">Home</a></li>
                <li><a href="index.php?page=user&subpage=cview">View Customer</a></li>
                <li><a href="index.php?page=user&subpage=taxiview">View Taxi</a></li>
                <li><a href="index.php?page=driver&subpage=driverview">View Driver</a></li>
                <li><a href="index.php?page=user&subpage=view">View User</a></li>
                <li><a href="index.php?page=booking&subpage=bookingview">View Bookings</a></li>
            </ul>
        </div>
        <div class ="main_content"> 
        <div class = "header">Welcome!
                <a class = "logout" href="log-in/log-in.php?page=log-in">Log Out</a>
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
         ?>
    </div>
</body>
</html>

