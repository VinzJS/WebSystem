<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=".date("Y-m-d")."-taxi-report.xls");

include_once 'C:\web\Xampp\htdocs\MainFolder(1)\classes\class.booking.php';
include 'C:\web\Xampp\htdocs\MainFolder(1)\user-main\config\config.php';

$booking = new booking();

echo 'Nbr' . "\t" . 'Taxi Model' . "\t" . 'Customer Name' . "\t" . 'Date' . "\t" . 'Price' . "\n";

$count = 1;
if($booking->list_booking() != false){
    foreach($booking->list_booking() as $value){
        extract($value);
                
            echo $count . "\t" . $taxi_model. "\t".$customer_first . "\t" . $booking_date. "\t" . $booking_price . "\n";
            
                $count++;
    }
}