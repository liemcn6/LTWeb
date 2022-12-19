<?php
	$title = 'Phụ kiện';
	$baseUrl = '../../';
    include_once ($baseUrl.'FE/layouts_FE/header.php');
    $UrlCartView = '../..';
    include_once ($baseUrl.'cart/add_cart_quickview.php')
?>
<link rel="stylesheet" href="<?=$baseUrl?>FE/layouts_FE/css/phukien.css">
<link rel="stylesheet" href="<?=$baseUrl?>FE/layouts_FE/css/chitietsanpham.css">
<style>
    .wide-nav-items-span {
        color: #777;
    }
    .danhmuc-phukien {
        color: #000;
    }
</style>
<div class="shop-big-img-box">
    <div class="shop-big-img" style="background-image: url(https://ezcomclass.com/wp-content/uploads/2020/06/image-0-compressed-16-300x225.jpg)"></div>
    </div>
</div>
<div class="grid wide phukien">
    <div class="phu-kien-header">
        <span class="phu-kien-header-tit">PHỤ KIỆN NỔI BẬT</span>
        <div class="phu-kien-header-main">
            <?php
                $sql = "SELECT * FROM product_type WHERE category_id=42 limit 0,9";
                $data = executeResult($sql);
                require_once('../../FE/convert_tv.php');
                foreach($data as $item) {
                    $name_product_type = $item['name'];
                    $name_product_type = strtolower($name_product_type);
                    $name_product_type = vn_to_str($name_product_type);
                    echo '
                    <div class="phu-kien-header-items">
                        <a href="#'.$name_product_type.'" class="tag-a">
                            <div class="phu-kien-header-items-box-img">
                                <img src="'.$item['thumnail'].'" alt="">
                            </div>
                        </a>
                        <div class="phu-kien-header-items-des">'.$item['name'].'</div>
                    </div>
                    ';
                }
            ?>
        </div>
    </div>
</div>
<div class="phu-kien-body">
    <?php
        $sql = "SELECT * FROM product_type WHERE category_id = 42";
        $data = executeResult($sql);
        foreach($data as $item) {
            $name_product_type = $item['name'];
            $name_product_type2 = strtolower($name_product_type);
            $name_product_type2 = vn_to_str($name_product_type);
            $sql = "SELECT * FROM product WHERE product_type = '$name_product_type' limit 0,4";
            $data = executeResult($sql);
            echo '
            <div class="'.$name_product_type2.'" id="'.$name_product_type2.'">
                <div class="sac-box-img">
                    <img src="'.$item['thumnail2'].'" alt="">
                </div>
                <div class="sac-main-box">
                    <div class="row sac-main">
            ';
            foreach($data as $item) {
                if(isset($_SESSION['email'])) {
                    $Url_cart = 'cart/cart_home.php?add_to_cart='.$item['id'];
                }else {
                    $Url_cart = 'authen/login';
                }
            
            echo '<div class="col l-3 c-6 product-selling-items shop-cuahang-items" style="">
                    <div class="product-selling-box-img">
                        <a href="'.$baseUrl.'category/sanpham/sp.php?sp='.$item['id'].'"><img src="'.$baseUrl.$item['thumnail'].'"   alt=""></a>
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
            echo '
                </div>
                </div>
            </div>
            ';
        }
    ?>
</div>
<div class="modal_quick_view">
    <div class="container_quick_view">
    </div>
</div>

<?php
	require_once($baseUrl.'FE/layouts_FE/footer.php');
?>
<script>
    var x = "../quickview_ajax_category.php"
    $(document).ready(function() {
        $('.btn-product-selling').click(function() {
            var id_product = $(this).attr('data-prog')
            $.get(x,{id_product_ajax:id_product},function(data) {
                $('.container_quick_view').html(data);
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
</script>
<script src="<?=$baseUrl?>FE/js/index.js"></script>