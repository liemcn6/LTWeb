<?php
	$title = 'Chi tiết';
	$baseUrl = '../';
    include_once ($baseUrl.'FE/layouts_FE/header.php');
    if(isset($_SESSION['email'])) {
        $email =  $_SESSION['email'];
        $sql = "SELECT fullname,id FROM user WHERE email ='$email'";
        $data = executeResult($sql,true);
        $user_name = $data['fullname'];
        $user_id = $data['id'];
    }
    if(!empty($_POST)) {
        $status = getPost('status');
        $sql = "UPDATE orders SET status='$status' WHERE user_name = '$user_name'";
        execute($sql);
    }
?>
<link rel="stylesheet" href="../FE/layouts_FE/css/detail.css">
<?php
    if(isset( $user_name) ) {
        $total_money = 0;
        $sql = "SELECT * FROM orders WHERE user_name = '$user_name' ";
        $data = executeResult($sql);
        if(!empty($data) ) {
            if($data[0]['status']==0 || $data[0]['status']==1 ) {
        
        
    ?>
<div class="grid wide detail">
    <div class="detail-title"><span>CHI TIẾT ĐƠN HÀNG</span></div>
    <div class="row">
        <div class="col l-6">
            <table class="cart_table" style="width:100%;">
                <tbody>
                    <tr>  
                        <div class="">
                        <th class="cart_product">SẢN PHẨM</th>
                        <th>SỐ LƯỢNG</th>
                        <th>TẠM TÍNH</th>
                        </div>  
                        
                    </tr>
                    <?php
                    
                    foreach($data as $item) {
                        $total_money = $total_money+ $item['total_money'];
                        echo '
                        <tr class="cartList">
                            <td class="cart_product">
                                <div class="cart-items-name cart_body" style="padding-top:15px">
                                    <span>'.$item['product'].'</span>
                                </div>
                            </td>
                            <td class="num" style="font-weight: 600; text-align: center; padding-top:15px">'.$item['num'].'</td>
                            <td class="total_money_details" style="font-weight: 600; text-align: center; padding-top:15px">'.number_format($item['total_money']).'<sup>đ</sup></td>
                        </tr>
                        ';
                    }
                ?>
                </tbody>
            </table>
            <div class="total_money">
                <span>Tổng tiền:</span>
                <span><?=number_format($total_money)?></span>
            </div>
        </div>
        <div class="col l-6" style="padding-left:70px;">
            <div class="infor-order">
                <div class="infor-title">
                    <span>THÔNG TIN ĐƠN HÀNG</span>
                </div>
                <div class="ma-order">
                    <span>Mã đơn hàng:</span>
                    <p class="ma-don-hang"><?='SHINESKY00'.$user_id.'vsny'?></p> 
                </div>
                <div class="phone_number">
                    <span>Số điện thoại:</span>
                    <p><?=$data[0]['phone_number']?></p>
                </div>
                <div class="address">
                    <span>Địa chỉ giao hàng:</span>
                    <p><?=$data[0]['xa_phuong'].','.$data[0]['quan_huyen'].','.$data[0]['tinh_tp']?></p>
                </div>
            </div>
            <form action="" method="post">
            <div class="success-btn">
                <button type="submit">
                    <div class="view-detail">
                        <input type="text" name="status" value="3" hidden>
                        <span>HỦY ĐƠN HÀNG</span>
                    </div>
                </button>
                <a href="../" class="tag-a">
                    <div class="continue-buy">
                        <span>TIẾP TỤC MUA SẮM</span>
                    </div>
                </a>
            </div>
            </form>
        </div>
    </div>
</div>
<?php
    }else {
        echo '<span class="not-order">BẠN CHƯA CÓ ĐƠN HÀNG NÀO</span>
            <a href="../" class="tag-a">
                <div class="continue_view continue_view1" >
                    <i class="fas fa-long-arrow-alt-left"></i>
                    <span>QUAY LẠI CỬA HÀNG</span>
                </div>
            </a>';
    }
    }else {
        echo '<span class="not-order">BẠN CHƯA CÓ ĐƠN HÀNG NÀO</span>
            <a href="../" class="tag-a">
                <div class="continue_view" style="width:200px;margin-top:40px; margin-left:200px">
                    <i class="fas fa-long-arrow-alt-left"></i>
                    <span>QUAY LẠI CỬA HÀNG</span>
                </div>
            </a>';
    }
    }else{
    echo '<span class="not-order">BẠN CHƯA CÓ ĐƠN HÀNG NÀO</span>
            <a href="../" class="tag-a">
                <div class="continue_view" style="width:200px;margin-top:40px; margin-left:200px">
                    <i class="fas fa-long-arrow-alt-left"></i>
                    <span>QUAY LẠI CỬA HÀNG</span>
                </div>
            </a>';
}
?>
<?php
    include_once ($baseUrl.'FE/layouts_FE/footer.php');
?>
<script src="../FE/js/index.js"></script>