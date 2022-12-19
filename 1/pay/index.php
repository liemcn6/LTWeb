<?php
	$title = 'Thanh toán';
	$baseUrl = '../';
    include_once ($baseUrl.'FE/layouts_FE/header.php');
    $quan_huyen = $tinh_tp = '';
    if(isset($_SESSION['email'])) {
        $email =  $_SESSION['email'];
        $sql = "SELECT fullname FROM user WHERE email ='$email'";
        $data = executeResult($sql,true);
        $user_name = $data['fullname'];
    }
    $sql = "SELECT * FROM devvn_tinhthanhpho";
    $data = executeResult($sql);
    if(!empty($_POST)) {
        $phone_number = getPost('phone_number');
        $matinh_tp =  getPost('matp');
        $maquan_huyen = getPost('maqh');
        if($matinh_tp != "#") {
            $sql = "SELECT name FROM devvn_tinhthanhpho WHERE matp='$matinh_tp'";
            $data = executeResult($sql,true);
            $tinh_tp = $data['name'];
        }   
        if($maquan_huyen != "#") {
            $sql = "SELECT name FROM devvn_quanhuyen WHERE maqh='$maquan_huyen'";
            $data = executeResult($sql,true);
            $quan_huyen = $data['name'];
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $xa_phuong = getPost('maphuongxa');
        $pay_note = getPost('pay_note');
        $created_at = date('Y-m-d h:m:s');
        $total_money_main = 0;
        $sql = "SELECT product_id,num FROM cart WHERE user_name = '$user_name'";
        $data = executeResult($sql);
        foreach($data as $item) {
            $product_id = $item['product_id'];
            $sql = "SELECT title,discount FROM product WHERE id = '$product_id'";
            $data = executeResult($sql,true);
            $discount = $data['discount'] * $item['num'];
            $product = $data['title'];
            $num = $item['num'];
            // $total_money_main = $total_money_main + $discount ;
            var_dump($total_money_main);
            if($quan_huyen != null && $xa_phuong != null && $tinh_tp != null) {
                $sql = "INSERT INTO  orders (user_name,phone_number,tinh_tp,quan_huyen,xa_phuong,note,created_at,product,num,total_money,status) VALUES 
                ('$user_name','$phone_number','$tinh_tp','$quan_huyen','$xa_phuong','$pay_note','$created_at','$product','$num','$discount',0)";
                execute($sql);
                header("Location: ../success");
            } else {
                echo 'VUI LÒNG ĐIỀN ĐẦY ĐỦ THÔNG TIN';
            }
            
        }
        
    }
?>
<link rel="stylesheet" href="../FE//layouts_FE/css/pay.css">
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<div class="grid wide">
    <div class="row">
        <form action="" class="form_pay" method="POST">
            <div class="col col-pay l-6 c-12 infor-pay-box">
                <div class="infor-pay">
                    <div class="infor-pay-title">
                        <span>THÔNG TIN THANH TOÁN</span>
                    </div>
                    <div class="infor-pay-name">
                        <label for="">Tên người nhận:</label>
                        <span><?=$user_name?></span>
                    </div>
                    <div class="infor-pay-phone">
                        <label for="">Số điện thoại:</label>
                        <input type="tel" required="true" name="phone_number">
                    </div>
                    <div class="address-giaohang">
                        <label for="">Địa chỉ nhận hàng:</label>
                        <div class="address-main">
                            <div class="tinh-thanh-pho flex">
                                <label for="">Tỉnh/thành phố:</label>
                                <select name="matp" id="matp">
                                    <option value="#">--Chọn--</option>
                                    <?php
                                    foreach ($data as $item=>$key) {
                                        echo '<option value="'.$key['matp'].'">'.$key['name'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="quan-huyen-main flex">
                                <label for="">Quận/huyện:</label>
                                <select name="maqh" id="maqh">
                                    <option value="#">--Chọn--</option>
                                </select>
                            </div>
                            <div class="xa-phuong flex">
                                <label for="">Thị trấn/xã/phường:</label>
                                <select name="maphuongxa" id="phuongxa">
                                <option value="#">--Chọn--</option>
                                </select>
                            </div>  
                        </div>
                    </div>
                    <div class="infor-note">
                        <label for="">Ghi chú:</label>
                        <input type="text" placeholder="" name="pay_note">
                    </div>
                </div>
            </div>
            <div class="col l-6 c-12 your-order-box" >
                <div class="your-order">
                    <div class="your-order-title">
                        <span>ĐƠN HÀNG CỦA BẠN</span>
                    </div>
                    <div class="pay_san_pham">
                        <span class="san-pham">SẢN PHẨM</span>
                        <span class="tam-tinh2">TẠM TÍNH</span>
                    </div>
                    <div class="pay_san_pham-main">
                        <?php
                            $total_money_main = 0;
                            $sql = "SELECT product_id,num FROM cart WHERE user_name = '$user_name'";
                            $data = executeResult($sql);
                            foreach($data as $item) {
                                $product_id = $item['product_id'];
                                $sql = "SELECT title,discount FROM product WHERE id = '$product_id'";
                                $data = executeResult($sql,true);
                                $discount = $data['discount'] * $item['num'];
                                $product = $data['title'];
                                $num = $item['num'];
                                $total_money_main = $total_money_main + $discount;
                                echo '
                                <div class="pay_san_pham_item">
                                    <div class="title-product">
                                        <span name="abc">'.$product.' </span>
                                        <p>x</p>
                                        <p>'.$num.'</p>
                                    </div>
                                    <span class="thanhtoan_discount">'.number_format($discount).'<sup>đ</sup></span>
                                </div>';
                                
                            }
                            
                        ?>
                    </div>
                    <div class="giao-hang-main pay_giao_hang">
                        <label for="">Giao hàng</label>
                        <div class="phi-giao-hang"><span style="padding-top: 4px;padding-right:6px">Đồng giá:</span>  <span style="font-weight: 600;">20.000<sup>đ</sup></span></div>
                    </div>
                    <div class="total_money pay_total_money">
                        <div class="total_money-title">
                            <span style="font-size: 16px;">Tổng tiền:</span>
                        </div>
                        <?php 
                            $phi_ship = 20000;
                            $total_money_main = $total_money_main + $phi_ship;
                            echo '<div class="total-main" name="total-main">'.number_format( $total_money_main).'<sup>đ</sup></div>';
                        ?>
                    </div>
                    <div class="phuong-thuc-pay">
                        <div class="phuong-thuc-pay-items-box">
                            <div class="phuong-thuc-pay-items">
                                <input type="radio" name="radio" class="a" data-title="#a1">
                                <span>Thanh toán khi nhận hàng</span>
                            </div>
                            <div class="pay-box  abcd block" id="a1">
                            Trả tiền mặt khi giao hàng
                            </div>
                        </div>
                        <div class="phuong-thuc-pay-items-box">
                            <div class="phuong-thuc-pay-items">
                                <input type="radio" name="radio" class="a" data-title="#a2">
                                <span>Chuyển khoản ngân hàng</span>
                            </div>
                            <div class="pay-box  abcd" id="a2">
                                Thực hiện thanh toán vào ngay tài khoản 
                                ngân hàng của chúng tôi. Vui lòng sử dụng 
                                Mã đơn hàng của bạn trong phần Nội dung thanh toán. 
                                Đơn hàng sẽ đươc giao sau khi tiền đã chuyển.
                            </div>
                        </div>
                        <div class="phuong-thuc-pay-items-box">
                            <div class="phuong-thuc-pay-items">
                                <input type="radio" name="radio" class="a" data-title="#a3">
                                <span>Thanh toán với PayPal</span>
                            </div>
                            <div class="pay-box  abcd" id="a3">
                                Trả thông qua Paypal; bạn có thể thanh toán với thẻ tín dụng nếu bạn không có tài khoản PayPal.
                                Các giá sẽ được chuyển đổi sang USD ở trên trang của PayPal với tỷ giá USD / VND = 22770.
                            </div>
                        </div>
                        <div class="phuong-thuc-pay-items-box">
                            <div class="phuong-thuc-pay-items">
                                <input type="radio" name="radio" class="a" data-title="#a4">
                                <span>Quét mã MoMo</span>
                            </div>
                            <div class="pay-box  abcd" id="a4">
                            Hãy mở App Momo lên và nhấn Đặt Hàng để quét mã thanh toán
                            </div>
                        </div>
                        <div class="phuong-thuc-pay-items-box">
                            <div class="phuong-thuc-pay-items">
                                <input type="radio" name="radio" class="a" data-title="#a5">
                                <span>Cổng thanh toán nội địa OnePay</span>
                            </div>
                            <div class="pay-box  abcd" id="a5">
                                Với OnePay, bạn có thể thanh toán bằng bất cử thẻ ATM nội địa nào của Việt Nam.
                                <img src="../assets/photos/nganhang.png" alt="">
                            </div>
                        </div>
                        <div class="phuong-thuc-pay-items-box">
                            <div class="phuong-thuc-pay-items">
                                <input type="radio" name="radio" class="a" data-title="#a6">
                                <span>Cổng thanh toán Quốc tế OnePay</span>
                            </div>
                            <div class="pay-box  abcd" id="a6" >
                                Với OnePay, bạn có thể thanh toán sử dụng các thẻ quốc tế như Visa, Master, JCB, hay Amex.
                                <img style="width:100%;height:100px;object-fit:cover;" src="../assets/photos/nganhang2.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="dat_hang">ĐẶT HÀNG</button>
            </div>
        </form>
    </div>
    
</div>
<?php
    include_once ($baseUrl.'FE/layouts_FE/footer.php');
?>
<script>
    const a = document.querySelectorAll('.a')
    a[0].checked = true
    for(let i=0;i<a.length;i++) {
       a[i].onclick = function(e) {
            document.querySelector('.pay-box.block').classList.remove('block')
            const b = a[i].getAttribute('data-title')
            const abc = document.querySelector(b)
            abc.classList.add('block')
       }
    }
</script>
<script>
    $(document).ready(function() {
        $('#matp').change(function() {
            var a = $(this).val()
            $.get("a-jax1.php",{a_ajax1:a},function(data) {
                $("#maqh").html(data);
                $('#maqh').change(function() {
                var b = $(this).val()
                $.get("a-jax2.php",{a_ajax2:b},function(data) {
                    $("#phuongxa").html(data);
                })
        })
            })
        })
    })
</script>
<script src="../FE/js/index.js"></script>