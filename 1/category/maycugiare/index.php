<?php
	$title = 'Máy cũ giá rẻ';
	$baseUrl = '../../';
    include_once ($baseUrl.'FE/layouts_FE/header.php');
    $UrlCartView = '../..';
    include_once ($baseUrl.'cart/add_cart_quickview.php')
?>
<style>
.wide-nav-items-span {
    color: #777;
}
.danhmuc-maycugiare {
    color: #000 !important;
}
.maycu {
    margin-top: 50px;
}
.maycu-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 30px;
}
.product-selling-box-img a img {
    width: 252px;
    height: 252px;
    object-fit: cover;
}
@media  screen and (max-width:740px) {
    .product-selling-box-img a img {
        width: 180px;
        height: 180px;
    }
    .maycu-title {
        margin-left: 25px;
    }
}
</style>
<link rel="stylesheet" href="<?=$baseUrl?>FE/layouts_FE/css/chitietsanpham.css">
<div class="maycu">
    <div class="grid wide ">
        <div class="maycu-title">
            <span>MÁY CŨ NỔI BẬT</span>
        </div>
        <div class="row">
        <?php
            $product_type = "Máy cũ";
            $sql = "SELECT * FROM product WHERE product_type = '$product_type'";
            $data = executeResult($sql);
            foreach($data as $item) {
                if(isset($_SESSION['email'])) {
                    $Url_cart = 'cart/cart_home.php?add_to_cart='.$item['id'];
                }else {
                    $Url_cart = 'authen/login';
                    $message = "Bạn hãy đăng nhập để thêm sản phẩm vào giỏ hàng của mình!!!";
                }
                echo '
                <div class="col l-3 c-6 product-selling-items shop-cuahang-items">
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

        ?>
        </div>
    </div>
</div>

<div class="modal_quick_view">
    <div class="container_quick_view">
    </div>
</div>
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

<?php
	require_once($baseUrl.'FE/layouts_FE/footer.php');
?>
<script src="<?=$baseUrl?>FE/js/index.js"></script>