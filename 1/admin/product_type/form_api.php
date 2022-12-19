<?php
session_start();
require_once('../../utils/ulitity.php');
require_once('../../database/dbhelper.php');

// $user = getUserToken();
// if($user == null) {
//     die();
// }
if(!empty($_POST)) {
    $action = getPost('action');
    switch ($action) {
        case 'delete':
            deleteCategory();
            break;
    }
}
function deleteCategory() {
    $id = getPost('id');
    // $sql = "SELECT COUNT(*) as total FROM product WHERE category_id = $id ";
    // $data = executeResult($sql,true);
    // $total = $data['total'];
    // if($total > 0) {
    //     echo 'Danh mục đang chứa sản phẩm,không được xóa!!!';
    //     die();
    // }
    $sql = "DELETE FROM product_type WHERE id = $id";
    execute($sql);
}