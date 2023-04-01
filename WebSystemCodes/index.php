<?php
include 'user-main/config.php';
include 'user-main/user-class.php';


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
    <link rel="stylesheet" href="user-main/stylesheets1.css">
</head>
<body>
    <div class ="wrapper">
        <div class ="sidebar">
            <h2>User</h2>
            <ul>
                <li><a href="index.php?page=user">Home</a></li>
                <li><a href="#">View Taxi</a></li>
                <li><a href="#">View Driver</a></li>
                <li><a href="index.php?page=user&subpage=view">View User</a></li>
            </ul>
        </div>
        <div class ="main_content"> 
        <div class = "header">Welcome!
                <a class = "logout" href="/MainFolder/log-in/log-in.php?page=log-in">Log Out</a>
            </div>
        <?php
        switch($subpage){
                case 'view':
                    require_once 'user-main/index.php';
                break; 
                case 'none':
                    require_once 'dada.php';
                break; 
                case 'module_xxx':
                    require_once 'module-folder';
                break; 
                default:
                    require_once 'index.php';
                break; 
            }
         ?>
    </div>
</body>
</html>
