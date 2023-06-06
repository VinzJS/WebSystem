<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=".date("Y-m-d")."-taxi-report.xls");

include_once 'C:\web\Xampp\htdocs\MainFolder(1)\classes\class.taxi.php';
include 'C:\web\Xampp\htdocs\MainFolder(1)\user-main\config\config.php';

$taxi = new taxi();

echo 'Nbr' . "\t" . 'Plate #' . "\t" . 'Model' . "\t" . 'Car Type' . "\t" . 'Capacity' . "\t" . 'Transmission' . "\n";

$count = 1;
if($taxi->list_taxi() != false){
    foreach($taxi->list_taxi() as $value){
        extract($value);
                
            echo $count . "\t" . $taxi_plate. "\t".$taxi_model . "\t" . $taxi_type. "\t" . $taxi_capacity . "\t" . $taxi_transmission . "\n";
            
                $count++;
    }
}