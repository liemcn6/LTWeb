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
    $sql = "DELETE FROM color WHERE id = $id";
    execute($sql);
}