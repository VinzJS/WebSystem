<?php
include '../user-module/user-class.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
	case 'new':
        create_new_user();
	break;
    case 'update':
        update_user();
	break;
    case 'deactivate':
        deactivate_user();
	break;
}

function create_new_user(){
	$user = new User();
    $email = $_POST['email'];
    $lastname = ucwords($_POST['lastname']);
    $firstname = ucwords($_POST['firstname']);
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $result = $user->new_user($email,$password,$lastname,$firstname);
    if($result){
        $id = $user->get_user_id($email);
        header('location: /MainFolder/index.php?page=user&subpage=view');
    }
}

function update_user(){
	$user = new User();
    $user_id = $_POST['userid'];
    $lastname = ucwords($_POST['lastname']);
    $firstname = ucwords($_POST['firstname']);
   
    
    $result = $user->update_user($lastname,$firstname,$user_id);
    if($result){
        header('location: ../index.php?page=settings&subpage=users&action=profile&id='.$user_id);
    }
}

function deactivate_user(){
	$user = new User();
    $user_id = $_POST['userid']; 
    $result = $user->deactivate_user($user_id);
    if($result){
        header('location: ../index.php?page=settings&subpage=users&action=profile&id='.$user_id);
    }
}
