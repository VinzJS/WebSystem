<?php
include 'C:\web\Xampp\htdocs\MainFolder(1)\classes\user-class.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
	case 'new':
        create_new_user();
	break;
    case 'update':
        update_user();
	break;
    case 'delete_user':
        delete_user();
	break;
}

function create_new_user(){
	$user = new User();
    $email = $_POST['email'];
    $lastname = ucwords($_POST['lastname']);
    $firstname = ucwords($_POST['firstname']);
    $access = $_POST ['access']; 
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $result = $user->new_user($email,$password,$lastname,$firstname,$access);
    if($result){
        $id = $user->get_user_id($email);
        header('location: /MainFolder(1)/index.php?page=user&subpage=view');
    }
}

function update_user(){
	$user = new User();
    $user_id = $_POST['id'];
    $lastname = ucwords($_POST['lastname']);
    $firstname = ucwords($_POST['firstname']);
    $email = $_POST['email'];
    $access = $_POST ['access']; 
    $result = $user->update_user($user_id,$lastname, $firstname, $email,$access);
    if($result){
        header('location: /MainFolder(1)/index.php?page=user&subpage=view');
    }
}

function delete_user(){
if ($_POST['action'] == 'delete_user') {
    $user_id = $_POST['user_id'];
    $user = new User();
    $result = $user->delete_user($user_id);
    if($result){
        header('location: /MainFolder(1)/index.php?page=user&subpage=view');
    }
}
}
