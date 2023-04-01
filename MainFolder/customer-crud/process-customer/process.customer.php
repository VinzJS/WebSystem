<?php
include 'C:\web\Xampp\htdocs\MainFolder\classes\class.customer.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
    case 'add_customer':
        create_new_customer();
	break;

}

function create_new_customer(){
	$customer = new customer();
    $customer_first = ucwords($_POST['cfirst']);
    $customer_last = ucwords($_POST['clast']);
    $customer_phone = ucwords ($_POST['phone']);
    $customer_address = ucwords ($_POST['caddress']);
    $customer_id = $customer->new_customer($customer_first,$customer_last,$customer_phone,$customer_address);
    if(is_numeric($customer_id)){
        header('location: /../MainFolder/index.php?page=user&subpage=cview');
    }
}

