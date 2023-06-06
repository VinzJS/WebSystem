<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=".date("Y-m-d")."-user-report.xls");

include_once 'C:\web\Xampp\htdocs\MainFolder(1)\classes\user-class.php';
include 'C:\web\Xampp\htdocs\MainFolder(1)\user-main\config\config.php';

$user = new User();

echo 'Nbr' . "\t" . 'Name' . "\t" . 'Access Level' . "\t" . 'E-Mail' . "\n";

$count = 1;
if($user->list_users() != false){
    foreach($user->list_users() as $value){
        extract($value);
                
            echo $count . "\t" . $user_lastname.', '.$user_firstname . "\t" . $user_access . "\t" . $user_email . "\n";
            
                $count++;
    }
}