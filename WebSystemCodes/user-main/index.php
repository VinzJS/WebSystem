<?php
include_once 'user-class.php';
/* instantiate class object */
$user = new User();
?>
<div id="subcontent">
            <?php
            switch($action){
                case 'add':
                    require_once 'create-user.php';
                break; 
                case 'modify':
                    require_once 'users-module/modify-user.php';
                break; 
                case 'profile':
                    require_once 'users-module/view-profile.php';
                break;
                case 'result':
                    require_once 'users-module/search-user.php';
                break;
                default:
                    require_once 'user-main/main.php';
                break; 
            }
    ?>
  </div>