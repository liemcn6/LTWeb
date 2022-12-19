<?php
if(!empty($_POST)) {
    $id = getPost('id');
    $product_type = getPost('product_type');
    $title = getPost('title');
    $price = getPost('price');
    $discount = getPost('discount');
    $thumnail = moveFile('thumnail');
    $listImg_desct = $_FILES['thumnail_desct']['name'];
    $description = getPost('description');
    $description2 = getPost('description2');
    $category_id = getPost('category_id');
    $created_at = $updated_at = date('Y-m-d H:s:i');
    // Lấy ra cấu hính
    $man_hinh = getPost('man_hinh');
    $he_dieu_hanh = getPost('he_dieu_hanh');
    $cam_truoc = getPost('cam_truoc');
    $cam_sau = getPost('cam_sau');
    $chip = getPost('chip');
    $ram = getPost('ram');
    $bo_nho_trong = getPost('bo_nho_trong');
    $sim = getPost('sim');
    $pin_sac = getPost('pin_sac');
    if(!empty($_POST['rom'])) {
        $rom = $_POST['rom'];
    }
    if(!empty($_POST['color'])) {
        $color = $_POST['color'];
    }
    if($id > 0 ) {
        //update
        if($thumnail != '' ) {
            $sql = "SELECT thumnail FROM product WHERE id = $id";
            $data = executeResult($sql,true);
            $thumnail_file = fixUrl($data['thumnail']);
            unlink("$thumnail_file");
            $sql = "UPDATE product SET thumnail='$thumnail',  title = '$title',category_id = '$category_id',price='$price',discount = '$discount',description='$description',description2 = '$description2' WHERE id =$id";
            execute($sql);
        } else {
            $sql = "UPDATE product SET product_type = '$product_type', title = '$title',category_id = '$category_id',price='$price',discount = '$discount',description='$description',description2 = '$description2' WHERE id =$id";
            execute($sql);
        }
        $sql = "UPDATE cau_hinh SET man_hinh = '$man_hinh' ,he_dieu_hanh = '$he_dieu_hanh',cam_truoc = '$cam_truoc',
            cam_sau = '$cam_sau',chip = '$chip',ram = '$ram',bo_nho_trong = '$bo_nho_trong',sim = '$sim',pin_sac = '$pin_sac' WHERE product_id =$id";
        execute($sql);
        if($rom != null) {
            $sql = "DELETE  FROM rom WHERE product_id ='$id'";
            execute($sql);
            foreach($rom as $value){
                $sql = "INSERT INTO rom(product_id,rom_main) VALUES ('$id','$value')";
                execute($sql);
            }
        }else {
            echo 'Hãy chọn bộ nhớ';
        }
        if($color != null) {
            $sql = "DELETE  FROM color WHERE product_id ='$id'";
            execute($sql);
            foreach($color as $value){
                $sql = "INSERT INTO color(product_id,name) VALUES ('$id','$value')";
                execute($sql);
            }
        }else {
            echo 'Hãy chọn màu sắc';
        }
        header('Location: index.php');
        die();
    } else {
    // insert
        if($thumnail != '') {
            $sql = "INSERT INTO product (title,category_id,product_type,price,discount,thumnail,description,description2,created_at,updated_at) 
            VALUES ('$title','$category_id','$product_type','$price','$discount','$thumnail','$description','$description2','$created_at','$updated_at')";
            execute($sql);
            // THÊM ẢNH PHỤ VÀO DATABASE
            $sql = "SELECT * FROM product ORDER BY id DESC ";
            $id_product_array = executeResult($sql,true);
            $id_product = $id_product_array['id'];
            $pathTemp = $_FILES['thumnail_desct']["tmp_name"];
            foreach($listImg_desct as $key => $value) {
                $img_desct = "assets/photos/".$value;
                move_uploaded_file($pathTemp[$key],"../../".$img_desct);
                $sql = "INSERT INTO img_desct (img_desct,product_id) VALUES ('$img_desct','$id_product')";
                execute($sql);
            }
            // Thêm cấu hình vào database 
            $sql = "SELECT * FROM product ORDER BY id DESC ";
            $id_product_array = executeResult($sql,true);
            $id_product = $id_product_array['id'];
            $sql = "INSERT INTO cau_hinh (product_id,man_hinh,he_dieu_hanh,cam_truoc,cam_sau,chip,ram,bo_nho_trong,sim,pin_sac) VALUES 
            ('$id_product','$man_hinh','$he_dieu_hanh','$cam_truoc','$cam_sau','$chip','$ram','$bo_nho_trong','$sim','$pin_sac')";
            execute($sql);
            foreach($rom as $value){
                $sql = "INSERT INTO rom(product_id,rom_main) VALUES ('$id_product','$value')";
                execute($sql);
            }
            foreach($color as $value){
                $sql = "INSERT INTO color(product_id,name) VALUES ('$id_product','$value')";
                execute($sql);
            }
            header('Location: index.php');
            die();
        }
    }
}
