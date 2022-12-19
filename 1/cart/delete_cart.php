<?php
    include_once '../database/dbhelper.php';
    include_once '../utils/ulitity.php';
    if(isset($_GET['delete_cart'])) {
        session_start();
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $data = executeResult($sql,true);
        $user_id = $data['id'];
        $product_id = $_GET['delete_cart'];
        $sql = "DELETE  FROM cart WHERE product_id = '$product_id' AND user_id = '$user_id'";
        execute($sql);
        header('Location: ./');
    }
?>