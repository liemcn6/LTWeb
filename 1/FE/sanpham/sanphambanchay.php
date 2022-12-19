<?php
    require_once ('utils/ulitity.php');
    require_once ('database/dbhelper.php');

    
?>
<link rel="stylesheet" href="FE//layouts_FE/css/chitietsanpham.css">
<style> 
    .modal_quick_view {
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.4);
        z-index: 20;
        display: flex;
        align-items: center;
        justify-content: center;
        display: none; 
    }
    .container_quick_view {
        width: 875px;
        height: 90vh;
        background-color: #fff;
    }
    .quick_view-box-img {
        overflow: hidden;
        display: flex;
        padding-top: 15px;
        padding-left: 30px;
    }
    .quick_view-box-img img {
        width: 400px;
        height: 400px;
        object-fit: cover;
    }
    .flex {
        display: flex;
    }
    .infor_product-quick-view {
        max-width: 390px;
    }
</style>
<div class="grid wide">
    <div class="product-selling-title">
        <hr>
        <span>SẢN PHẨM NỔI BẬT</span>
        <hr>
    </div>
    <div class="product-selling-main">
        <div class="row">
            <?php
                $sql = "SELECT id FROM category WHERE id>39 AND id<44";
                $data = executeResult($sql);
                foreach($data as $category_id) {
                    $category_id = $category_id['id'];
                    $sql = "SELECT * FROM product WHERE category_id='$category_id'  order by updated_at asc limit 0,2";
                    $data = executeResult($sql);
                    foreach($data as $item) {
                        if(isset($_SESSION['email'])) {
                            $Url_cart = 'cart/cart_home.php?add_to_cart='.$item['id'];
                        }else {
                            $Url_cart = 'authen/login';
                            $message = "Bạn hãy đăng nhập để thêm sản phẩm vào giỏ hàng của mình!!!";
                        }
                        echo '
                        <div class="col  l-3 c-6 product-selling-items">
                            <div class="product-selling-box-img">
                                <a href="category/sanpham/sp.php?sp='.$item['id'].'"><img  class="product-selling-img" src="'.fixUrl($item['thumnail'],$roothPath="./").'" alt=""></a>
                                <div class="btn btn-product-selling" name="btn-product-selling" data-prog="'.$item['id'].'">QUICK VIEW</div>
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
                }
                
            ?>
        </div>
    </div>
</div>