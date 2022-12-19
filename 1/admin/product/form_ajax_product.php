<?php
// Tên 2 biến và tên trong array get phải trùng nhau
    $baseUrl = '';
    require_once('../../database/dbhelper.php');
    require_once('../../utils/ulitity.php');
    $category_id_ajax = $_GET['category_id_ajax'];
    $sql = "SELECT * FROM product_type WHERE category_id='$category_id_ajax'";
    $product_typeItems = executeResult($sql);
    echo '<option value="#">--Chọn--</option>';
    foreach ($product_typeItems as $item) {
        echo '<option value="'.$item['name'].'">'.$item['name'].'</option>';
    }
?>