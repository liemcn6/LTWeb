<?php
    
    if(!empty($_POST)) {
        if(isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            $sql = "SELECT * FROM user WHERE email = '$email'";
            $data = executeResult($sql,true);
            $user_id = $data['id'];
            $user_name = $data['fullname'];
            $num = $_POST['num'];
            $product_id = $_POST['btn-add-cart'];
            $sql = "SELECT * FROM product WHERE id = '$product_id'";
            $data = executeResult($sql,true);
            $discount = $data['discount'];
            $product_id = $data['id'];
            $sql = "SELECT product_id,num FROM cart WHERE product_id = '$product_id' AND user_id='$user_id'";
            $data = executeResult($sql,true);
            if($data != null) {
                $num_carted = $data['num'];
            }
            if($data == null) {
                $sql = "INSERT INTO cart (user_id,user_name,product_id,price,num) VALUES ('$user_id','$user_name','$product_id','$discount','$num')";
                execute($sql);
            }else {
                $num_update = $num_carted + $num;
                $sql = "UPDATE cart SET num = '$num_update' WHERE product_id = '$product_id' AND user_id='$user_id'";
                execute($sql);
            }
            header("location: $UrlCartView/cart");
        } else {
            header("location: $UrlCartView/authen/login");
        }
        
    }
?>