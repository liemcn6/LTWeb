<?php
    require_once ('./utils/ulitity.php');
    require_once ('./database/dbhelper.php');
    $sql = "SELECT * FROM product WHERE category_id=41 order by created_at desc limit 0,4";
    $data = executeResult($sql);
?>
<div class="grid wide">
    <div class="product-selling-title">
        <hr>
        <span>GIẢM GIÁ SỐC</span>
        <hr>
    </div>
        <div class="product-selling-main">
            <div class="row">
                <?php
                    if(isset($_SESSION['email'])) {
                        $Url_cart = 'cart/cart_home.php?add_to_cart='.$item['id'];
                    }else {
                        $Url_cart = 'authen/login';
                        $message = "Bạn hãy đăng nhập để thêm sản phẩm vào giỏ hàng của mình!!!";
                    }
                    foreach($data as $item) {
                        echo '
                        <div class="col l-3 c-6 product-selling-items">
                            <div class="product-selling-box-img">
                            <a href="category/sanpham/sp.php?sp='.$item['id'].'"><img  class="product-selling-img" src="'.fixUrl($item['thumnail'],$roothPath="./").'" alt=""></a>
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
                                    <a  href="'.$Url_cart.'"  class="tag-a link-add-cart"><span class="btn-add-cart">THÊM VÀO GIỎ HÀNG</span></a>
                                </div>
                            </div>
                        </div>';
                    }
                ?>
            </div>
        </div>
</div>  