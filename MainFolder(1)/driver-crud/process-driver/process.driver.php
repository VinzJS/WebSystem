<?php
include 'C:\web\Xampp\htdocs\MainFolder(1)\classes\class.driver.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
    case 'add_driver':
        create_new_driver();
	break;
    case 'update_driver':
        update_driver();
    break;
    case 'delete_driver':
        delete_driver();
    break;
}
/* Adds a data to the table */
function create_new_driver(){
	$driver = new driver();
    $rid = $_POST['id'];
    $fname= ucwords($_POST['fname']);
    $lname = ucwords ($_POST['lname']);
    $dob= $_POST['dob'];
    $age = $_POST['age']; 
    $gender= ucwords($_POST['gender']);
    $exp= $_POST['exp'];
    $rid = $driver->new_driver($fname,$lname,$dob,$age,$gender,$exp);
    if(is_numeric($rid)){
        header('location: /MainFolder(1)/index.php?page=user&subpage=driverview');
    }
}

function update_driver(){
	$driver = new driver();
    $rid = $_POST['id'];
    $fname= ucwords($_POST['fname']);
    $lname = ucwords ($_POST['lname']);
    $dob= $_POST['dob'];
    $age = $_POST['age']; 
    $gender= ucwords($_POST['gender']);
    $exp= $_POST['exp'];
    $result = $driver->update_driver($rid,$fname,$lname,$dob,$age,$gender,$exp);
    if($result){
        header('location: /MainFolder(1)/index.php?page=user&subpage=driverview');
    }
}

function delete_driver(){
if ($_POST['action'] == 'delete_driver') {
    $driver_id = $_POST['driver_id'];
    $driver = new driver();
    $result = $driver->delete_driver($driver_id);
    if($result){
        header('location: /MainFolder(1)/index.php?page=user&subpage=driverview');
    }
}
}