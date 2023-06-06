<?php
include 'C:\web\Xampp\htdocs\MainFolder(1)\classes\class.taxi.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
    case 'add_taxi':
        create_new_taxi();
	break;
    case 'update_taxi':
        update_taxi();
    break;
    case 'delete_taxi':
        delete_taxi();
    break;
}
/* Adds a data to the table */
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
        header('location: /MainFolder(1)/index.php?page=user&subpage=taxiview');
    }
}

function update_taxi(){
	$taxi = new taxi();
    $tid = $_POST['taxid'];
    $plate = ucwords($_POST['plate']);
    $model= ucwords($_POST['model']);
    $type = ucwords ($_POST['type']);
    $capacity = ucwords ($_POST['capacity']);
    $transmission = ucwords ($_POST['transmission']);
    $status = ucwords ($_POST['status']);
    $result = $taxi->update_taxi($tid,$plate,$model,$type,$capacity,$transmission,$status);
    if($result){
        header('location: /MainFolder(1)/index.php?page=user&subpage=taxiview');
    }
}

function delete_taxi(){
if ($_POST['action'] == 'delete_taxi') {
    $taxi_id = $_POST['taxi_id'];
    $taxi = new taxi();
    $result = $taxi->delete_taxi($taxi_id);
    if($result){
        header('location: /MainFolder(1)/index.php?page=user&subpage=taxiview');
    }
}
}