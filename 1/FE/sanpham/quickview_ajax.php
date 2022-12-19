<?php
$baseUrl = '';
require_once ('../../database/dbhelper.php');
require_once ('../../utils/ulitity.php');
$id_product_ajax = $_GET['id_product_ajax'];
$sql = "SELECT * FROM product WHERE id = $id_product_ajax";
$data = executeResult($sql,true);
$category_id = $data['category_id'];
$sql = "SELECT name FROM category WHERE id = $category_id";
$category = executeResult($sql,true);
$category_name = $category['name'];
echo '<div class="row">
            <div class="col l-6 quick_view-box-img owl-carousel owl-theme">
                <img src="'.$baseUrl.$data['thumnail'].'" alt="">
            </div>
            <div class="col l-6 ">
                <div class="chitiet-description" style="padding-top: 12px;">
                    <div class="type-product">
                        <span style="text-transform: uppercase;">'.$category_name.'</span>
                    </div>
                    <div class="chitiet-des-name" style="font-size: 25px;">
                        <span>'.$data['title'].'</span>
                    </div>
                    <div class="chitiet-des-price" style="display: flex;">
                        <span style="text-decoration: line-through;color: rgb(117,117,117); font-weight:100; font-size: 16px;padding:5px">'.number_format($data['price']).'<sup>đ</sup></span>
                        <span>'.number_format($data['discount']).'<sup>đ</sup></span>
                    </div>
                    <ul class="infor-product infor_product-quick-view">
                        <li>'.$data['description'].'</li>
                    </ul>
                    <div class="rest-product">
                        <span>còn '.$data['hang_con'].' hàng</span>
                    </div>
                    <form method="post" class="quantity-product">
                        <input type="button" value="-" class="tru">
                        <input type="number" name="num" id="" class="value-quantity" value="1">
                        <input type="button" value="+" class="cong">';
                        session_start();
                        if(isset($_SESSION['email'])) {
                            $Url_cart = 'cart/cart_home.php?add_to_cart=';
                        }else {
                            $Url_cart = 'authen/login';
                        }
                        echo '<button onclick=alertChitiet() data-title="'.$Url_cart.'" type="submit"   name="btn-add-cart" value="'.$id_product_ajax.'" class="btn chitiet-add-cart">THÊM VÀO GIỎ HÀNG</button>';
                    echo '</form>
                </div>
            </div>
    </div>';
?>
<script>
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