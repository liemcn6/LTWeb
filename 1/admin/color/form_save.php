<?php
if(!empty($_POST)) {
    $id = getPost('id');
    $name = getPost('name');
    if($id > 0) {
        $sql = "UPDATE color SET name='$name' WHERE id=$id";
        execute($sql);
    } else {
        $sql = "INSERT INTO color (name) VALUES ('$name')";
        execute($sql);
    }
}