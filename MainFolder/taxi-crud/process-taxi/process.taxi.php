<?php
include 'C:\web\Xampp\htdocs\MainFolder\classes\class.taxi.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
    case 'add_taxi':
        create_new_taxi();
	break;
    case 'additem':
        new_receive_item();
	break;
    case 'saveitem':
        save_receive_items();
	break;
}

function create_new_taxi(){
	$taxi = new taxi();
    $tid = $_POST['taxid'];
    $plate = ucwords($_POST['plate']);
    $model= ucwords($_POST['model']);
    $type = ucwords ($_POST['type']);
    $capacity = ucwords ($_POST['capacity']);
    $transmission = ucwords ($_POST['transmission']);
    $status = ucwords ($_POST['status']);
    $tid = $taxi->new_taxi($plate,$model,$type,$capacity,$transmission,$status);
    if(is_numeric($tid)){
        header('location: /../MainFolder/index.php?page=user&subpage=taxiview');
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
