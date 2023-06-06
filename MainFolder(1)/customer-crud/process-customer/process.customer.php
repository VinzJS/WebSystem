<?php
include 'C:\web\Xampp\htdocs\MainFolder(1)\classes\class.customer.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
    case 'add_customer':
        create_new_customer();
	break;
    case 'update_customer':
        update_customer();
    break;
    case 'delete_customer';
        delete_customer();
    break;

}
/* Adds a data to the table */
function create_new_customer(){
	$customer = new customer();
    $customer_first = ucwords($_POST['cfirst']);
    $customer_last = ucwords($_POST['clast']);
    $customer_phone = ucwords ($_POST['phone']);
    $customer_address = ucwords ($_POST['caddress']);
    $customer_id = $customer->new_customer($customer_first,$customer_last,$customer_phone,$customer_address);
    if(is_numeric($customer_id)){
        header('location: /MainFolder(1)/index.php?page=user&subpage=cview');
    }
}

function update_customer(){
	$customer = new customer();
    $customer_id = $_POST['id'];
    $customer_first = ucwords($_POST['cfirst']);
    $customer_last = ucwords($_POST['clast']);
    $customer_phone = ucwords ($_POST['phone']);
    $customer_address = ucwords ($_POST['caddress']);
    $result = $customer->update_customer($customer_id,$customer_first,$customer_last,$customer_phone,$customer_address);
    if($result){
        header('location: /MainFolder(1)/index.php?page=user&subpage=cview');
    }
}
function delete_customer(){
if ($_POST['action'] == 'delete_customer') {
    $customer_id = $_POST['customer_id'];
    $customer = new customer();
    $result = $customer->delete_customer($customer_id);
    if($result){
        header('location: /MainFolder(1)/index.php?page=user&subpage=cview');
    }
}
}
