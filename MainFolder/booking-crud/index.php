<?php
include_once 'C:\web\Xampp\htdocs\MainFolder\classes\class.booking.php';
include_once 'C:\web\Xampp\htdocs\MainFolder\classes\class.taxi.php';
include_once 'C:\web\Xampp\htdocs\MainFolder\classes\class.customer.php';
?>

<div id="third-submenu">
     | 
    Search <input type="text"/>
</div>
<div id="subcontent">
    <?php
      switch($action){
                case 'new_booking':
                    require_once 'create-booking.php';
                break;
                default:
                    require_once 'booking-crud/main.php';
                break; 
            }
    ?>
  </div>