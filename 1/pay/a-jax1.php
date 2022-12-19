<?php
require_once('../database/dbhelper.php');
require_once('../utils/ulitity.php');
    $a_ajax1 = $_GET['a_ajax1'];
    $sql = "SELECT * FROM devvn_quanhuyen WHERE matp='$a_ajax1'";
    $data = executeResult($sql);
        echo '<option value="#">--Chọn--</option>';
        foreach($data as $item => $key) {
            echo '<option value="'.$key['maqh'].'">'.$key['name'].'</option>';
        }
?>