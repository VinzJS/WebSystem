<?php
include 'C:\web\Xampp\htdocs\MainFolder\classes\class.driver.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
    case 'add_driver':
        create_new_driver();
	break;
    case 'additem':
        new_receive_item();
	break;
    case 'saveitem':
        save_receive_items();
	break;
}

function create_new_driver(){
	$driver = new driver();
    $fname= ucwords($_POST['fname']);
    $lname = ucwords ($_POST['lname']);
    $dob= $_POST['dob'];
    $age = $_POST['age']; 
    $gender= ucwords($_POST['gender']);
    $exp= $_POST['exp'];
    $rid = $driver->new_driver($fname,$lname,$dob,$age,$gender,$exp);
    if(is_numeric($rid)){
        header('location: /../MainFolder/index.php?page=driver&subpage=driverview');
    }
}

function new_receive_item(){
	$driver = new driver();
    $recid= $_POST['recid'];
    $prodid= $_POST['prodid']; 
    $qty= $_POST['qty']; 
    $rid = $driver->new_receive_item($recid, $prodid, $qty);
    if($rid){
        header('location: ../index.php?page=receive&action=receive&id='.$recid);
    }
}

function save_receive_items(){
	$driver = new driver();
    $id = $_POST['recid'];
    $driver->save_to_inventory($id);
    $rid = $driver->save_receive_items($id);
    if($rid){
        header('location: ../index.php?page=receive&action=receive&id='.$id);
    }
}
