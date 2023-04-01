<?php
include_once 'C:\web\Xampp\htdocs\MainFolder\classes\class.driver.php';
?>
<div id="third-submenu">
    <a href="index.php?page=receive">Receiving List</a> | 
    <a href="index.php?page=receive&action=create">New Transaction</a> | 

    Search <input type="text"/>
</div>
<div id="subcontent">
    <?php
      switch($action){
                case 'add_driver':
                    require_once 'create-driver.php';
                break; 
                case 'receive':
                    require_once 'receive-module/receive-products.php';
                break; 
                case 'profile':
                    require_once 'receive-module/view-product.php';
                break;
                case 'types':
                    require_once 'receive-module/list-product-types.php';
                break;
                case 'upload':
                    require_once 'receive-module/imageupload.php';
                break;
                default:
                    require_once 'driver-crud/main.php';
                break; 
            }
    ?>
  </div>