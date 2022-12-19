<?php
$baseUrl = '../';
include_once $baseUrl.'database/dbhelper.php';
include_once $baseUrl.'utils/ulitity.php';
session_start();
$email = $_SESSION['email'];
$sql = "SELECT * FROM user WHERE email = '$email'";
$data = executeResult($sql,true);
$user_id = $data['id'];
$user_name = $data['fullname'];
if(isset($_GET['add_to_cart'])) {
    $id = $_GET['add_to_cart'];
    $sql = "SELECT * FROM product WHERE id = '$id'";
    $data = executeResult($sql,true);
    $discount = $data['discount'];
    $product_id = $data['id'];
    $num = 1;
    $sql = "SELECT product_id,num FROM cart WHERE product_id = '$product_id' AND user_id='$user_id'";
    $data = executeResult($sql,true);
    if($data != null) {
        $num = $data['num'];
    }
    if($data == null) {
        $sql = "INSERT INTO cart (user_id,user_name,product_id,price,num) VALUES ('$user_id','$user_name','$product_id','$discount','$num')";
        execute($sql);
    }else {
        $num_update = $num+1;
        $sql = "UPDATE cart SET num = '$num_update' WHERE product_id = '$product_id' AND user_id='$user_id'";
        execute($sql);
    }
    header('location: ../cart');
}