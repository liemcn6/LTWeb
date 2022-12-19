<?php
	$title = 'Chi tiết sản phẩm';
	$baseUrl = '../../';
    include_once ($baseUrl.'FE/layouts_FE/header.php');
    $UrlCartView = '../..';
    include ($baseUrl.'cart/add_cart_quickview.php')
?>
<link rel="stylesheet" href="<?=$baseUrl?>FE/layouts_FE/css/chitietsanpham.css">
<div class="grid wide">
    <div class="chitietsanpham">
        <div class="chitiet-header">
            <div class="row">
                <div class="col l-6 c-12">
                    <?php 
                        $id = getGet('sp');
                        $sql = "SELECT * FROM product WHERE id = $id";
                        $data = executeResult($sql,true);
                        $x = $data['product_type'];
                        echo '<div class="chitiet-big-img">
                                <img src="'.$baseUrl.$data['thumnail'].'" alt="" style="object-fit: cover">
                            </div>';
                    ?>
                    <div class="chitiet-small-img">
                        <?php
                        echo ' <div class="chitiet-small-box-img " style="height: 75px">
                                    <img src="'.$baseUrl.$data['thumnail'].'" alt="" >
                                 </div>';
                        $sql = "SELECT img_desct FROM img_desct WHERE product_id = $id";
                        $img_desctItems = executeResult($sql);
                            foreach ($img_desctItems as $a => $b) {
                                foreach ($b as $c => $d) {
                                    $e = $baseUrl.$d;
                                    echo '<div class="chitiet-small-box-img " style="height: 75px">
                                            <img src="'.$e.'" alt="" >
                                        </div>';
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="col l-6 c-12">
                    <div class="chitiet-description">
                        <?php
                            require_once('../../FE/convert_tv.php');
                            $category_id = $data['category_id'];
                            $sql = "SELECT name FROM category WHERE id = $category_id";
                            $category = executeResult($sql,true);
                            $category_name = $category['name'];
                            $category_link = vn_to_str($category_name);
                        ?>
                        <div class="type-product">
                            <a href="../<?=$category_link?>" class="tag-a"><span style="text-transform: uppercase;"><?=$category_name?></span></a>
                        </div>
                        <div class="chitiet-des-name">
                            
                            <span><?=$data['title']?></span>
                        </div>
                        <div class="chitiet-des-price">
                            <span style="text-decoration: line-through;color: rgb(117,117,117); font-weight:100; font-size: 16px"><?=number_format($data['price'])?></span>
                            <span><?=number_format($data['discount'])?><sup>đ</sup></span>
                        </div>
                        <div class="bo-nho-trong">
                            <?php
                                $sql = "SELECT rom_main FROM rom WHERE product_id='$id'";
                                $dataRom = executeResult($sql);
                                foreach($dataRom as $itemRom) {
                                    if($itemRom['rom_main'] != '') {
                                        echo '
                                        <div class="bo-nho-item ">
                                            <p>'.$itemRom['rom_main'].'</p>
                                        </div>
                                        ';
                                    }
                                    
                                }
                            ?>
                        </div>
                        <div class="mau-sanpham">
                            <?php
                                $sql = "SELECT name FROM color WHERE product_id='$id'";
                                $dataColor = executeResult($sql);
                                foreach($dataColor as $itemColor) {
                                    if($itemColor['name'] != '') {
                                        echo '
                                        <div class="mau-sanpham-item ">
                                            <p style="text-transform: uppercase">'.$itemColor['name'].'</p>
                                        </div>
                                        ';
                                    } 
                                    
                                }
                            ?>
                        </div>
                        <ul class="infor-product">
                            <?=$data['description']?>
                        </ul>
                        <div class="rest-product">
                            <span>Còn <?=$data['hang_con']?> hàng</span>
                        </div>
                        <form method="post" class="quantity-product">
                            <!-- <div class="quantity-product"> -->
                                <input type="button" value="-" class="tru">
                                <input type="number" name="num" id="" class="value-quantity" value="1">
                                <input type="button" value="+" class="cong">
                                <?php
                                    if(isset($_SESSION['email'])) {
                                        $Url_cart = 'cart/cart_home.php?add_to_cart='.$data['id'];
                                    }else {
                                        $Url_cart = 'authen/login';
                                    }
                                    echo '<button onclick=alertChitiet() data-title="'.$Url_cart.'" type="submit"   name="btn-add-cart" value="'.$id.'" class="btn chitiet-add-cart">THÊM VÀO GIỎ HÀNG</button>';
                                ?>
                            <!-- </div> -->
                        </form>
                        <div class="chitiet-des-bottom">
                            <span>MÃ: dt<?=$data['id']?></span>
                            <span style="text-transform: uppercase;"><?='Danh mục:'.' '.$category_name?></span>
                            <span><p><?=$category_name?></p> <?=$data['product_type']?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="chitiet-body">
            <div class="chitiet-body-header">
                <div class="chitiet-body-title">
                    <span class="chitiet-title-mota chitiet-body-active" data-title="#chitiet-mota">
                        CẤU HÌNH
                    </span>
                    <span class="chitiet-title-rate" data-title="#chitiet-rate">ĐÁNH GIÁ <p class="quantity-rate">(0)</p></span>
                </div>
                <div class="chitiet-mota chitiet-active" id="chitiet-mota">
                    <ul class="cauhinh_product-box">   
                        <?=$data['description2']?>
                        <?php
                            $sql = "SELECT * FROM cau_hinh WHERE product_id = $id";
                            $cau_hinh_Items = executeResult($sql,true);
                        ?>
                        <?php 
                            if($cau_hinh_Items['man_hinh'] != "") {
                                echo '
                                    <li class="cauhinh_product tag-li cauhinh_product-0">
                                        <p class="cauhinh_left">Màn hình:</p>
                                        <div class="cauhinh_right">
                                            <p>'.$cau_hinh_Items['man_hinh'].'</p>
                                        </div>
                                    </li>
                                ';
                            }
                            if($cau_hinh_Items['he_dieu_hanh'] != "") {
                                echo '
                                    <li class="cauhinh_product tag-li ">
                                        <p class="cauhinh_left">Hệ điều hành:</p>
                                        <div class="cauhinh_right">
                                            <p>'.$cau_hinh_Items['he_dieu_hanh'].'</p>
                                        </div>
                                    </li>
                                ';
                            }
                            if($cau_hinh_Items['cam_sau'] != "") {
                                echo '
                                    <li class="cauhinh_product tag-li cauhinh_product-0">
                                        <p class="cauhinh_left">Camera sau:</p>
                                        <div class="cauhinh_right">
                                            <p>'.$cau_hinh_Items['cam_sau'].'</p>
                                        </div>
                                    </li>
                                ';
                            }
                            if($cau_hinh_Items['cam_truoc'] != "") {
                                echo '
                                    <li class="cauhinh_product tag-li ">
                                        <p class="cauhinh_left">Camera trước:</p>
                                        <div class="cauhinh_right">
                                            <p>'.$cau_hinh_Items['cam_truoc'].'</p>
                                        </div>
                                    </li>
                                ';
                            }
                            if($cau_hinh_Items['chip'] != "") {
                                echo '
                                    <li class="cauhinh_product tag-li cauhinh_product-0">
                                        <p class="cauhinh_left">Chip:</p>
                                        <div class="cauhinh_right">
                                            <p>'.$cau_hinh_Items['chip'].'</p>
                                        </div>
                                    </li>
                                ';
                            }
                            if($cau_hinh_Items['ram'] != "") {
                                echo '
                                    <li class="cauhinh_product tag-li ">
                                        <p class="cauhinh_left">RAM:</p>
                                        <div class="cauhinh_right">
                                            <p>'.$cau_hinh_Items['ram'].'</p>
                                        </div>
                                    </li>
                                ';
                            }
                            if($cau_hinh_Items['bo_nho_trong'] != "") {
                                echo '
                                    <li class="cauhinh_product tag-li cauhinh_product-0">
                                        <p class="cauhinh_left">Bộ nhớ trong:</p>
                                        <div class="cauhinh_right">
                                            <p>'.$cau_hinh_Items['bo_nho_trong'].'</p>
                                        </div>
                                    </li>
                                ';
                            }
                            if($cau_hinh_Items['sim'] != "") {
                                echo '
                                    <li class="cauhinh_product tag-li ">
                                        <p class="cauhinh_left">Sim:</p>
                                        <div class="cauhinh_right">
                                            <p>'.$cau_hinh_Items['sim'].'</p>
                                        </div>
                                    </li>
                                ';
                            }
                            if($cau_hinh_Items['pin_sac'] != "") {
                                echo '
                                    <li class="cauhinh_product tag-li cauhinh_product-0">
                                        <p class="cauhinh_left">Pin,sạc:</p>
                                        <div class="cauhinh_right">
                                            <p>'.$cau_hinh_Items['pin_sac'].'</p>
                                        </div>
                                    </li>
                                ';
                            }
                        ?>
                    </ul>
                </div>
                <div class="chitiet-rate" id="chitiet-rate">
                    <span>Chưa có đánh giá nào</span>
                    <div class="chitiet-rate-foot">Chỉ những khách hàng đã đăng nhập và mua sản phẩm này mới có thể đưa ra đánh giá.</div>
                </div>
            </div>
        </div>
        <div class="chitiet-foot">
            <div class="chitiet-foot-title">
                <span>SẢN PHẨM TƯƠNG TỰ</span>
            </div>
            <div class="grid wide product-selling-main">
                <div class="row">
                    <?php 
                        $sql2 = "SELECT * FROM product WHERE id != $id AND product_type ='$x'    order by updated_at desc limit 0,4 ";
                        $data2 = executeResult($sql2);
                        
                        foreach ($data2 as $item) {
                            if(isset($_SESSION['email'])) {
                                $Url_cart = 'cart/cart_home.php?add_to_cart='.$item['id'];
                            }else {
                                $Url_cart = 'authen/login';
                                $message = "Bạn hãy đăng nhập để thêm sản phẩm vào giỏ hàng của mình!!!";
                            }
                            echo '<div class="col l-3 c-6 product-selling-items">
                                    <div class="product-selling-box-img">
                                        <a href="'.$baseUrl.'category/sanpham/sp.php?sp='.$item['id'].'"><img src="'.$baseUrl.$item['thumnail'].'" alt="" ></a>
                                        <div class="btn btn-product-selling" data-prog="'.$item['id'].'">QUICK VIEW</div>
                                    </div>
                                    <div class="product-selling-info">
                                        <div class="product-selling-name">
                                        <span>'.$item['title'].'</span>
                                        </div>
                                        <div class="product-selling-price">
                                            <div class="product-selling-price-old">'.number_format($item['price']).'<sup>đ</sup></div>
                                            <div class="product-selling-price-now">'.number_format($item['discount']).'<sup>đ</sup></div>
                                        </div>
                                        <div class="btn-add-cart-box">
                                            <a  href="'.$baseUrl.$Url_cart.'"  class="tag-a link-add-cart"><span class="btn-add-cart">THÊM VÀO GIỎ HÀNG</span></a>
                                        </div>
                                    </div>
                                </div>';}
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sản phẩm nhỏ ở dưới -->
<div class="chitiet-sanpham-small">
    <div class="chitiet-sp-sm-box">
        <?php
            echo '
            <div class="chitiet-sp-sm-box-img">
                <img src="'.$baseUrl.$data['thumnail'].'" style="object-fit: cover; alt="">
            </div>
            <div class="chitiet-sp-sm-price">
                <span style="object-fit: cover;">'.number_format($data['discount']).'<sup>đ</sup></span>
            </div>
            ';
        ?>
        <div class="quantity-product chitiet-sp-sm-quantity">
            <input type="button" value="-" class="tru chitiet-sp-sm-tru">
            <input type="number" name="" id="" class="value-quantity chitiet-sp-sm-value-quantity" value="1">
            <input type="button" value="+" class="cong chitiet-sp-sm-cong">
            <button class="btn chitiet-add-cart chitiet-sp-sm-add-cart">THÊM VÀO GIỎ HÀNG</button>
        </div>
    </div>
</div>
<div class="modal_quick_view">
    <div class="container_quick_view">
    </div>
</div>
<?php
	require_once($baseUrl.'FE/layouts_FE/footer.php');
?>
<script src="../../FE/js/chitietsp.js"></script>
<script src="../../FE/js/index.js"></script>
<script>
    var x = "../quickview_ajax_category.php"
    $(document).ready(function() {
        $('.btn-product-selling').click(function() {
            var id_product = $(this).attr('data-prog')
            // alert(id_product)
            $.get(x,{id_product_ajax:id_product},function(data) {
                $('.container_quick_view').html(data);
                let a=1;
                $('.cong').click(function() {
                    a+=1
                    $('.value-quantity').val(a) 
                })
                $('.tru').click(function() {
                    if(a>1) {
                        a-=1
                        $('.value-quantity').val(a) 
                    }
                })
            })
        })
    })
    function alertChitiet() {
            const link_cart = 'cart/cart_home.php'
            const a = document.querySelector('.chitiet-add-cart')
            const attr = a.getAttribute('data-title')
            if(attr.indexOf(link_cart) !== -1) {
                return;
            }else {
                alert('Bạn hãy đăng nhập để thêm sản phẩm vào giỏ hàng của mình!!!')
            }
    }
</script>