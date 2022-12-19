<?php
if(!empty($_POST)) {
    $id = getPost('id');
    $category_id = getPost('category_id');
    $name = getPost('name');
    if($id > 0) {
        $sql = "UPDATE product_type SET name='$name',category_id='$category_id' WHERE id=$id";
        execute($sql);
    } else {
        $sql = "INSERT INTO product_type (name,category_id) VALUES ('$name','$category_id')";
        execute($sql);
    }
    
}