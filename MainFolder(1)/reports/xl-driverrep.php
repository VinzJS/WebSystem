<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=".date("Y-m-d")."-driver-report.xls");

include_once 'C:\web\Xampp\htdocs\MainFolder(1)\classes\class.driver.php';
include 'C:\web\Xampp\htdocs\MainFolder(1)\user-main\config\config.php';

$driver = new driver();

echo 'Nbr' . "\t" . 'Driver Name' . "\t" . 'DOB' . "\t" . 'Age' . "\t" . 'Gender' . "\t" . 'License Expire Date' . "\n";

$count = 1;
if($driver->list_driver() != false){
    foreach($driver->list_driver() as $value){
        extract($value);
                
            echo $count . "\t" . $dr_first. "\t".$dr_dob . "\t" . $dr_age . "\t" . $dr_gender . "\t" . $dr_exp . "\n";
            
                $count++;
    }
}