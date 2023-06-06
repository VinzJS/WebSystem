<?php
include 'C:\web\Xampp\htdocs\MainFolder(1)\classes\class.booking.php';
include 'C:\web\Xampp\htdocs\MainFolder(1)\classes\class.taxi.php';
include 'C:\web\Xampp\htdocs\MainFolder(1)\classes\class.customer.php';
$action = isset($_GET['action']) ? $_GET['action'] : '';
$booking = new booking();
switch($action){
    case 'new_booking':
        new_booking();
	break;

    case 'update_booking':
        update_booking();
	break;
    case 'delete_booking':
        delete_booking();
    break;
}
/* Adds a data to the table */
function new_booking(){
	$booking = new booking();
    $taxi = new taxi();
    $customer = new customer();
    $bookdate = $_POST['bookdate'];
    $price = $_POST['price'];
    $taximodel = $_POST['tid'];
    $customer_first = ucwords($_POST['customer_first']);
    $bookid = $booking->new_booking($bookdate,$price,$taximodel,$customer_first);
    if(is_numeric($bookid)){
        header('location: /MainFolder(1)/index.php?page=user&subpage=bookingview');
    }
}

function update_booking(){
	$booking = new booking();
    $taxi = new taxi();
    $customer = new customer();
    $book_id = $_POST ['book_id'];
    $bookdate = $_POST['bookdate'];
    $price = $_POST['price'];
    $taximodel = $_POST['tid'];
    $customer_first = ucwords($_POST['customer_first']);
    $bookid = $booking->update_booking($book_id, $bookdate, $price, $taximodel, $customer_first);
    if(is_numeric($bookid)){
        header('location: /MainFolder(1)/index.php?page=user&subpage=bookingview');
    }
}
function delete_booking(){
if ($_POST['action'] == 'delete_booking') {
    $book_id = $_POST['book_id'];
    $booking = new booking();
    $result = $booking->delete_booking($book_id);
    if($result){
        header('location: /MainFolder(1)/index.php?page=user&subpage=bookingview');
    }
}
}