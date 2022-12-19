<?php
	$title = 'Giỏ hàng';
	$baseUrl = '../';
    include_once ($baseUrl.'FE/layouts_FE/header.php');
    if(isset($_SESSION['email'])) {
        $email =  $_SESSION['email'];
        $sql = "SELECT id FROM user WHERE email ='$email'";
        $data = executeResult($sql,true);
        $user_id = $data['id'];
        $sql = "SELECT * FROM cart WHERE user_id= '$user_id'";
        $cart_List = executeResult($sql);
    }
    
?>
<link rel="stylesheet" href="../FE//layouts_FE/css/cart.css">
<link rel="stylesheet" href="../FE/layouts_FE/css//chitietsanpham.css">
<div class="grid wide">
    <div class="product-selling-title cart_youself-box">
        <hr>
        <span class="cart_youself">GIỎ HÀNG CỦA BẠN</span>
        <hr>
    </div>
    <div class="cart_main">
        <div class="row">
            <div class="col l-8 c-12 cart_pc" style="position: relative;">
                <form action="" method="post">
                    <table class="cart_table">
                        <tbody>
                            <tr>  
                                <div class="">
                                <th class="cart_product">SẢN PHẨM</th>
                                <th class="cart_price">GIÁ</th>
                                <th>SỐ LƯỢNG</th>
                                <th>TẠM TÍNH</th>
                                </div>  
                            </tr>
                            <?php
                            $total_money_main = 0;
                            foreach($cart_List as $item) {
                                if(!empty($_POST)) {
                                    $a = $item['product_id'];
                                    $num_update = $_POST[$a];
                                    $sql = "UPDATE cart SET num = '$num_update' WHERE product_id='$a' AND user_id='$user_id'";
                                    execute($sql);
                                    header('Location: ../cart');
                                }
                                $money_detail = 0;
                                $product_id = $item['product_id'];
                                $sql = "SELECT * FROM product WHERE id = '$product_id'";
                                $data = executeResult($sql,true);
                                $money_detail = $item['num'] * $item['price'];
                                $total_money_main = $total_money_main + $money_detail;
                                echo '
                                <tr class="cartList">
                                    <td class="cart_product">
                                        <div class="cart-items-remove-box cart_body">
                                            <a href="../cart/delete_cart.php?delete_cart='.$item['product_id'].'" class="cart-items-remove tag-a">x</a>
                                        </div>
                                        <div class="cart-items-img cart_body">
                                            <img src="'.$baseUrl.$data['thumnail'].'" alt="">
                                        </div>
                                        <div class="cart-items-name cart_body">
                                            <span>'.$data['title'].'</span>
                                        </div>
                                    </td>
                                    <td class="cart_body" style="font-weight: 600; text-align: center;">
                                        <span style="padding-top:17px;">'.number_format($item['price']).'<sup>đ</sup></span>
                                    </td>
                                    <td class="num" style="font-weight: 600; text-align: center;">
                                    <div class="quantity-product">
                                        <input type="button" value="-" class="tru">
                                        <input type="number" name="'.$item['product_id'].'" id="" class="value-quantity" value="'.$item['num'].'" >
                                        <input type="button" value="+" class="cong" onclick=subTotal()>
                                    </div>
                                    </td>
                                    <td class="total_money_details" style="font-weight: 600; text-align: center;padding-top:17px;">'.number_format($money_detail).'<sup>đ</sup></td>
                                </tr>';
                            }
                        ?>
                        </tbody>
                    </table>
                    <div class="cart_product_foot">
                        <a href="../" class="tag-a">
                            <div class="continue_view">
                                <i class="fas fa-long-arrow-alt-left"></i>
                                <span>TIẾP TỤC XEM SẢN PHẨM</span>
                            </div>
                        </a>
                        <button type="submit" class="update_cart opacity">
                            <span style="padding-top: 3px;font-size:13px;">CẬP NHẬT GIỎ HÀNG</span>
                        </button>
                    </div> 
                </form>
            </div>

            <!-- CART_MOBILE -->
            <div class="col c-12 cart_mobile" style="position: relative;">
                <form action="" method="post">
                    <div class="cart_table">
                            <div class="cart_table_header">  
                                <span class="">SẢN PHẨM</span>
                                <span>SỐ LƯỢNG</span>
                            </div>
                            <?php
                            $total_money_main = 0;
                            foreach($cart_List as $item) {
                                if(!empty($_POST)) {
                                    $a = $item['product_id'];
                                    $num_update = $_POST[$a];
                                    $sql = "UPDATE cart SET num = '$num_update' WHERE product_id='$a' AND user_id='$user_id'";
                                    execute($sql);
                                    header('Location: ../cart');
                                }
                                $money_detail = 0;
                                $product_id = $item['product_id'];
                                $sql = "SELECT * FROM product WHERE id = '$product_id'";
                                $data = executeResult($sql,true);
                                $money_detail = $item['num'] * $item['price'];
                                $total_money_main = $total_money_main + $money_detail;
                                echo '
                                <div class="cartList">
                                    <div class="cart_product">
                                        <div class="cart-items-img cart_body">
                                            <div class="cart-items-remove-box ">
                                                <a href="../cart/delete_cart.php?delete_cart='.$item['product_id'].'" class="cart-items-remove tag-a">x</a>
                                            </div>
                                            <img src="'.$baseUrl.$data['thumnail'].'" alt="">
                                        </div>
                                        <div class="cart-items-name cart_body">
                                            <span>'.$data['title'].'</span>
                                            <div class="price_num">
                                                <span  class="price">'.number_format($item['price']).'<sup>đ</sup></span>
                                                <span class="dau_nhan">x</span>
                                                <span class="num1">'.$item['num'].'</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="num" style="font-weight: 600; text-align: center;">
                                        <div class="quantity-product" style="padding-top:0px">
                                            <input type="button" value="-" class="tru">
                                            <input type="number" name="'.$item['product_id'].'" id="" class="value-quantity" value="'.$item['num'].'" >
                                            <input type="button" value="+" class="cong" onclick=subTotal()>
                                        </div>
                                    </div>
                                </div>';
                            }
                        ?>
                    </div>
                    <div class="cart_product_foot">
                        <a href="../" class="tag-a">
                            <div class="continue_view">
                                <i class="fas fa-long-arrow-alt-left"></i>
                                <span>TIẾP TỤC XEM SẢN PHẨM</span>
                            </div>
                        </a>
                        <button type="submit" class="update_cart update_cart2 opacity">
                            <span style="padding-top: 3px;font-size:13px;">CẬP NHẬT GIỎ HÀNG</span>
                        </button>
                    </div> 
                </form>
            </div>
            <div class="col l-4 c-12 cart_right">
                <div class="cart_right-header">
                    <span>CỘNG GIỎ HÀNG</span>
                </div>
                <div class="tam-tinh">
                    <span>Tạm tính</span>
                    <?php
                        echo '<div class="tam-tinh-money">'.number_format( $total_money_main).'<sup>đ</sup></div>';
                    ?>
                    
                </div>
                <div class="giao-hang">
                    <div class="giao-hang-title flex">
                        <span> Phí giao hàng</span>
                    </div>
                    <div class="giao-hang-main">
                        <div class="phi-giao-hang"><span style="padding-top: 4px;padding-right:6px">Đồng giá:</span>  <span style="font-weight: 600;">20.000<sup>đ</sup></span></div>
                    </div>
                </div>
                <div class="phieu-uu-dai">
                    <i class="fas fa-tag"></i>
                    <span style="font-weight: 600;font-size:17px;">Phiếu ưu đãi</span>
                </div>
                <div class="ma-uu-dai">
                    <input type="text" placeholder="Mã ưu đãi">
                    <button type="submit">Áp dụng</button>
                </div>
                <div class="total_money">
                    <div class="total_money-title">
                        <span>Tổng tiền:</span>
                    </div>
                    <?php 
                        $phi_ship = 20000;
                        $total_money_main = $total_money_main + $phi_ship;
                        echo '<div class="total-main">'.number_format( $total_money_main).'<sup>đ</sup></div>';
                    ?>
                    
                </div>
                <a href="<?=$baseUrl?>pay" class="tag-a ">
                    <div class="thanh-toan">
                        <span>TIẾN HÀNH THANH TOÁN</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="cart-empty-main">
        <div class="box-img-cart-empty">
            <img src="../assets/photos/cart-empty.png" alt="">
        </div>
        <div class="cart-empty-main-title">
            <span>GIỎ HÀNG TRỐNG</span>
        </div>
        <a href="../" class="tag-a">
            <div class="continue_view" style="width:200px;margin-top:40px; margin-left:15px;">
                <i class="fas fa-long-arrow-alt-left"></i>
                <span>QUAY LẠI CỬA HÀNG</span>
            </div>
        </a>
    </div>
</div>
<?php
    include_once ($baseUrl.'FE/layouts_FE/footer.php');
?>
<script>
    const $1 = document.querySelector.bind(document)
    const $2 = document.querySelectorAll.bind(document)
    for(let i=0;i<$2('.cong').length;i++) {
        let a1 = $2('.value-quantity')[i].value;
        a1 = parseInt(a1)
        $2('.cong')[i].onclick = function() {
            a1= a1+1
            $2('.value-quantity')[i].value = a1
            $1('.update_cart').classList.remove('opacity')
            $1('.update_cart2').classList.remove('opacity')
        }
        $2('.tru')[i].onclick = function() {
            if(a1<2){
                return 
            }else{
                $1('.update_cart').classList.remove('opacity')
                $1('.update_cart2').classList.remove('opacity')
                a1= a1-1
                $2('.value-quantity')[i].value = a1
            }
        }
    }
    const cartList =  $2('.cartList')
    if(cartList.length < 1) {
        $1('.cart_main').classList.add('none')
        $1('.cart_youself-box').classList.add('none')
        $1('.cart-empty-main').classList.add('block-cart')
    }else {
        $1('.cart_main').classList.remove('none')
        $1('.cart_youself-box').classList.remove('none')
        $1('.cart-empty-main').classList.remove('block-cart')
    }
    const cart = $2('.widget_shopping')
    const cart_empty = $1('.cart-empty')
    const box_cart_items = $1('.nav-drop-box')
    if(cart.length>0) {
    cart_empty.classList.remove('block')
    box_cart_items.classList.add('block')
    }
    $1('.logo-cart').innerHTML = cart.length
</script>