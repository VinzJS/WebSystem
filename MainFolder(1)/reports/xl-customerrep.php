<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=".date("Y-m-d")."-customer-report.xls");

include_once 'C:\web\Xampp\htdocs\MainFolder(1)\classes\class.customer.php';
include 'C:\web\Xampp\htdocs\MainFolder(1)\user-main\config\config.php';

$customer = new customer();

echo 'Nbr' . "\t" . 'Customer Name' . "\t" . 'Phone Number' . "\t" . 'Address' . "\n";

$count = 1;
if ($customer->list_customer() != false) {
    foreach ($customer->list_customer() as $value) {
        echo $count . "\t" . $customer->get_customer_first($value['customer_id']) . ',' . $customer->get_customer_last($value['customer_id']) . "\t" . $customer->get_customer_phone($value['customer_id']) . "\t" . $customer->get_customer_add($value['customer_id']) . "\n";
        $count++;
    }
}
?>
