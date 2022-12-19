<!-- Đây là giỏ hàng nhỏ -->
<?php
    // $baseUrl = '';
    include_once $baseUrl.'database/dbhelper.php';
    include_once $baseUrl.'utils/ulitity.php';
    if(isset($_SESSION['email'])) {
        $email =  $_SESSION['email'];
        $sql = "SELECT id FROM user WHERE email ='$email'";
        $data = executeResult($sql,true);
        $user_id = $data['id'];
        $sql = "SELECT * FROM cart WHERE user_id= '$user_id'";
        $cart_List = executeResult($sql);
    }
?>
<div class="cart">
    <span class="cart-text">GIỎ HÀNG</span>
    <div class="logo-cart-box"><div class="logo-cart">0</div></div>
    <ul class="nav-dropdown">
        <p class="block cart-empty">Chưa có sản phẩm trong giỏ hàng</p>
        <div class="nav-drop-box">
            <?php
            $total_money = 0;
            foreach($cart_List as $item) {
                $product_id = $item['product_id'];
                $sql = "SELECT * FROM product WHERE id = '$product_id'";
                $data = executeResult($sql,true);
                $money_detail = $item['num'] * $item['price'];
                $total_money = $total_money + $money_detail;
                echo '
                    <li class="widget_shopping tag-li">
                        <div class="widget_shopping_content">
                            <div class="cart-items">
                                <div class="cart-items-img">
                                    <img src="'.$baseUrl.$data['thumnail'].'" alt="">
                                </div>
                                <div class="cart-items-info">
                                    <div class="cart-items-name">
                                        <p>'.$data['title'].'</p>
                                    </div>
                                    <div class="cart-items-price">
                                        <span class="cart-items-quanity">'.$item['num'].'</span>
                                        <span>x</span>
                                        <div class="cart-items-price-one">'.number_format($item['price']).'</div>
                                    </div>
                                </div>
                                <div class="cart-items-remove-box">
                                    <a href="'.$baseUrl.'cart/delete_cart.php?delete_cart='.$item['product_id'].'" class="cart-items-remove tag-a">x</a>
                                </div>
                            </div>
                            <hr class="cart-hr">
                        </div>
                    </li>
                ';
            }
            echo '
            <div class="cart-total-box">
                <div class="cart-total-box1">
                    <span>Tổng tiền:</span>
                    <div class="cart-total">'.number_format($total_money).' <sup>đ</sup></div>
                </div>
                <hr class="cart-hr">
            </div>
            <a href="'.$baseUrl.'./cart" class="tag-a" style="color: #fff;">
                <div class="btn-cart-view btn">
                    <span>XEM GIỎ HÀNG</span>
                </div>
            </a>
            <a href="'.$baseUrl.'./pay" class="tag-a" style="color:#fff;">
                <div class="btn-cart-pay btn">
                    <span>THANH TOÁN</span>
                </div>
            </a>
            '
            ?>
        </div>
        <div class="nav-dropdown-hover"></div>
    </ul>
</div>
