<?php   
    $title = "Thêm/Sửa sản phẩm";
    $baseUrl = '../';
    require_once('../layouts/header.php');
    $id = $thumnail = $title = $price = $discount = $category_id = $description = $man_hinh = 
    $he_dieu_hanh = $cam_truoc = $cam_sau = $chip = $ram = $bo_nho_trong = $sim = $pin_sac = $product_type =$description2 ='' ;
    require_once('./form_save.php');
    $id = getGet('id');
    if($id != null && $id > 0) {
        $sql = "select * from product where id = '$id'";
        $productItem = executeResult($sql,true);
        if($productItem != null) {
            $thumnail = $productItem['thumnail'];
            $title = $productItem['title'];
            $price = $productItem['price'];
            $discount = $productItem['discount'];
            $category_id = $productItem['category_id'];
            $description = $productItem['description'];
            $description2 = $productItem['description2'];
            // Bảng cấu hình
            $sql1 = "SELECT * FROM cau_hinh WHERE product_id = $id";
            $cau_hinh_Items = executeResult($sql1,true);
            $man_hinh = $cau_hinh_Items['man_hinh'];
            $he_dieu_hanh = $cau_hinh_Items['he_dieu_hanh'];
            $cam_truoc = $cau_hinh_Items['cam_truoc'];
            $cam_sau = $cau_hinh_Items['cam_sau'];
            $chip = $cau_hinh_Items['chip'];
            $ram = $cau_hinh_Items['ram'];
            $bo_nho_trong = $cau_hinh_Items['bo_nho_trong'];
            $sim = $cau_hinh_Items['sim'];
            $pin_sac = $cau_hinh_Items['pin_sac'];
        }
        else {
            $id = 0;
        }
    }else {
        $id = 0;
    }
    $sql = "select * from category";
    $categoryItems = executeResult($sql);
    $sql = "SELECT img_desct FROM img_desct WHERE product_id = $id";
    $img_desctItems = executeResult($sql);
    $sql = "SELECT * FROM product_type";
    $product_typeItems = executeResult($sql);
    
?>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script src="../../ckfinder/ckfinder.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<div class="row">
	<div class="col-md-12" style="margin: 30px 0;">
		<h3>Thêm/sửa sản phẩm</h3>
        <div class="panel panel-primary">
            <div class="panel-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Tên sản phẩm:</label>
                        <input type="text" required="true" class="form-control" name="title" value="<?=$title?>" placeholder="Nhập tên sản phẩm">
                        <input type="text" class="form-control" name="id" value="<?=$id?>" hidden="true" >
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Danh mục sản phẩm:</label>
                        <select name="category_id" id="category_id" class="form-control" required="true">
                            <option value="">-- Chọn --</option>
                            <?php 
                                foreach($categoryItems as $item) {
                                    if($item['id'] == $category_id) {
                                        echo '<option selected value="'.$item['id'].'">'.$item['name'].'</option>';
                                    } else {
                                        echo '<option  value="'.$item['id'].'">'.$item['name'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Danh mục sản phẩm:</label>
                        <select name="product_type" id="product-type" class="form-control" required="true">
                            <option value="">-- Chọn --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Ảnh :</label>
                        <!-- Dùng khi muốn link ảnh trực tiếp -->
                        <!-- <input type="file" required="true" class="form-control thumnail" name="thumnail" value="<?=$thumnail?>" onchange="updateThumnail()">
                        <img src="<?=$thumnail?>" alt="" style="max-width: 150px;max-height:150px; margin-top: 10px;" class="thumnail_img"> -->
                        <input type="file"  class="form-control thumnail" name="thumnail" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                        <img src="<?=fixUrl($thumnail)?>" alt="" style="max-width: 150px;max-height:150px; margin-top: 10px;" class="thumnail_img">
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Ảnh mô tả:</label>
                        <input type="file"  multiple class="form-control thumnail" name="thumnail_desct[]" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                        <?php
                            foreach ($img_desctItems as $a => $b) {
                                foreach ($b as $c => $d) {
                                    $e = fixUrl($d);
                                    echo '
                                        <img src="'.$e.'" alt="" style="max-width: 150px;max-height:150px; margin-top: 10px;" class="thumnail_img">
                                    ';
                                }
                            }
                        ?>

                    </div>
                    <div class="form-group" style="display: flex;">
                        <label for="" style="font-weight: bold;">Dung lượng:</label>
                        <?php
                            $sql = "SELECT * FROM rom WHERE product_id=0";
                            $data = executeResult($sql);
                            foreach($data as $item) {
                                echo '
                                <input type="checkbox" name="rom[]" id="" value="'.$item['rom_main'].'" style="margin: 5px 3px 0 20px"> 
                                <span>'.$item['rom_main'].'</span>';
                            }
                        ?>
                    </div>
                    <div class="form-group" style="display: flex;">
                        <label for="" style="font-weight: bold;">Màu sắc:</label>
                        <?php
                            $sql = "SELECT * FROM color WHERE product_id=0";
                            $data = executeResult($sql);
                            foreach($data as $item) {
                                echo '
                                <input type="checkbox" name="color[]" id="" value="'.$item['name'].'" style="margin: 5px 3px 0 20px"> 
                                <span>'.$item['name'].'</span>';
                            }
                        ?>
                    </div>
                    
                <div class="form-group">
                        <label for="" style="font-weight: bold;">Giá cũ:</label>
                        <input class="form-control" type="number" required="true" class="form-control" name="price" value="<?=$discount?>">
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Giá mới:</label>
                        <input class="form-control" type="number" required="true" class="form-control" name="discount" value="<?=$price?>">
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Mô tả:</label>
                        <textarea class="form-group" name="description" id="" style="width: 100%;" rows="5" name="description"><?=$description?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Mô tả 2:</label>
                        <textarea class="form-group" name="description2" id="" style="width: 100%;" rows="5" name="description2"><?=$description2?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Màn hình</label>
                        <input class="form-control" type="text" id="" name="man_hinh" value="<?=$man_hinh?>">
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Hệ điều hành:</label>
                        <input class="form-control" type="text" id="" name="he_dieu_hanh" value="<?=$he_dieu_hanh?>">
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Camera sau:</label>
                        <input class="form-control" type="text" id="" name="cam_sau" value="<?=$cam_sau?>">
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Camera trước:</label>
                        <input class="form-control" type="text" id="" name="cam_truoc" value="<?=$cam_truoc?>">
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Chip:</label>
                        <input class="form-control" type="text" id="" name="chip" value="<?=$chip?>">
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Ram:</label>
                        <input class="form-control" type="text" id="" name="ram" value="<?=$ram?>">
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Bộ nhớ trong</label>
                        <input class="form-control" type="text" id="" name="bo_nho_trong" value="<?=$bo_nho_trong?>">
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Sim:</label>
                        <input class="form-control" type="text" id="" name="sim" value="<?=$sim?>">
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Pin,sạc:</label>
                        <input class="form-control" type="text" id="" name="pin_sac" value="<?=$pin_sac?>">
                </div>
                    <button type="submit" class="btn btn-success">Lưu</button>
                </form>
            </div>
        </div>
	</div>
</div>
<script>
    function updateThumnail() {
        $('.thumnail_img').attr('src', $('.thumnail').val())
    }
    // CKEDITOR.replace( 'description' );
    CKEDITOR.replace( 'description', {
        // filebrowserBrowseUrl: '';
        filebrowserBrowseUrl: '../ckfinder/ckfinder.html',
        filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    } );
    CKEDITOR.replace( 'description2', {
        // filebrowserBrowseUrl: '';
        filebrowserBrowseUrl: '../ckfinder/ckfinder.html',
        filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    } );
    $(document).ready(function() {
        $('#category_id').change(function() {
            // alert($(this).val())
            const category_id = $(this).val()
            $.get("form_ajax_product.php",{category_id_ajax:category_id},function(data) {
                $("#product-type").html(data);
            })
        })
    })
</script>