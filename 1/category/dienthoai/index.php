<?php
	$title = 'Điện thoại';
	$baseUrl = '../../';
    include_once ($baseUrl.'FE/layouts_FE/header.php');
    require_once ($baseUrl.'utils/ulitity.php');
    require_once ($baseUrl.'database/dbhelper.php');
    $UrlCartView = '../..';
    include_once ($baseUrl.'cart/add_cart_quickview.php')
?>
<link rel="stylesheet" href="<?=$baseUrl?>FE/layouts_FE/css/shop.css">
<link rel="stylesheet" href="<?=$baseUrl?>FE/layouts_FE/css/chitietsanpham.css">
<style>
        .wide-nav-items-span {
            color: #777;
        }
        .danhmuc-dienthoai {
            color: #000;
        }
        .product-type {
            margin-top: 17px;
            
        }
        .product-type a span {
            color: #000;
            padding: 5px 20px;
            width: max-content;
            border: 1px solid #e0dede;
            border-radius: 10px;
            margin: 10px 0
        }
</style>
<div class="shop-big-img-box">
    <div class="shop-big-img" style="background-image: url(https://tonycongmmo.com/wp-content/themes/flatsome/assets/img/effects/snow1.png),url(https://tonycongmmo.com/wp-content/themes/flatsome/assets/img/effects/snow2.png);"></div>
    <div class="shop-big-img-box-content">
        <div class="shop-big-img-content">
            <div class="shop-big-img-content-header">
                <span>Sale Sập Sàn</span>
            </div>
            <div class="shop-big-img-content-main">
                <span>BLACK FRIDAY</span>
            </div>
            <div class="shop-big-img-content-end">
                <span>OFF 20% TOÀN BỘ CỬA HÀNG</span>
            </div>
        </div>
    </div>
</div>
<div class="shop-body">
    <div class="grid wide">
        <div class="row">
            <div class="col l-3 shop-danhmuc">
                <div class="shop-danhmuc-header">
                    <span>ĐIỆN THOẠI </span>
                </div>
                <!-- filter-price -->
                <div class="wrapper1">
                    <span class="filter-price-title">LỌC THEO GIÁ</span>
                    <div class="container">
                        <div class="slider-track"></div>
                        <input type="range" min="0" max="50" value="0" id="slider-1" oninput="slideOne()">
                        <input type="range" min="2" max="50" value="50" id="slider-2" oninput="slideTwo()">
                    </div>
                    <div class="values">
                        <label for="">Giá:</label>
                        <span id="range1">
                            0
                        </span>
                        <span> &dash; </span>
                        <span id="range2">
                            100
                        </span>
                    </div>
                    <button type="submit" class="filter-price">LỌC</button>
                </div>
                <div class="shop-reducing-price">
                    <span class="shop-reducing-title">HÃNG SẢN XUẤT</span>
                    <div class="shop-reducing-items-box">
                        <div class="product-type">
                        <?php
                            require_once($baseUrl.'utils/ulitity.php');
                            require_once($baseUrl.'database/dbhelper.php');
                            $sql = "SELECT * FROM product_type WHERE category_id=40";
                            $data = executeResult($sql);
                            foreach($data as $item) {
                                $str = $item['name'];
                                $str = strtolower($str);
                                echo '
                                        <a href="'.$str.'" class= tag-a>
                                            <span>'.$item['name'].'</span>
                                        </a> 
                                    ';
                            }
                        ?>
                        </div>
                    </div>
                </div>
                <div class="shop-introducing">
                    <iframe width="230"  src="https://www.youtube.com/embed/MMdQ-gWBNZE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col l-9 shop-sanpham">
                <div class="shop-sanpham-title">
                    <?php
                        // Lấy ra số trang dựa theo số sản phẩm
                        $sql = "SELECT count(id) as number FROM product WHERE category_id = 40";
                        $data = executeResult($sql);
                        $number = 0;
                        if($data != null && count($data) >0) {
                            $number = $data[0]['number'];
                            
                        }
                        $page = ceil($number/6);
                        $current_page = 1;
                        if(isset($_GET['page'])) {
                            $current_page = $_GET['page'];
                            echo '<span class="page-now" data-title="'.$current_page.'"></span>';
                        }
                        $index = ($current_page - 1)*6;
                    ?>
                    <div class="shop-motasanpham">Hiển thị của <?=$index+1?> - <?=$index+6?><span class="shop-sanpham-page1"></span> của <span class="shop-tongsanpham"><?=$number?></span> kết quả</div></span>
                    <select name="" id="" class="shop-option">
                        <option value="">Mới nhất</option>
                        <option value="">Thứ tự mặc định</option>
                        <option value="">Thứ tự theo mức độ phổ biến</option>
                        <option value="">Thứ tự theo điểm gia</option>
                        <option value="">Thứ tự theo giá: thấp đến cao</option>
                        <option value="">Thứ tự theo giá: cao đến thấp</option>
                    </select>
                </div>
                <div class="row">
                    <?php
                    
                    $sql = "SELECT * FROM product  WHERE category_id = 40 ORDER BY id DESC limit $index,6";
                    $data = executeResult($sql);
                    foreach($data as $item) {
                        if(isset($_SESSION['email'])) {
                            $Url_cart = 'cart/cart_home.php?add_to_cart='.$item['id'];
                        }else {
                            $Url_cart = 'authen/login';
                            $message = "Bạn hãy đăng nhập để thêm sản phẩm vào giỏ hàng của mình!!!";
                        }
                        echo '
                        <div class="col l-4 c-6 product-selling-items shop-cuahang-items">
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
                <div class="shop-phantrang">
                    <?php
                        for($i=1;$i<=$page;$i++) {
                            echo '<a class="tag-a page-footer" href="?page='.$i.'" >
                                    <span class="shop-page2 " data-prog='.$i.'>'.$i.'</span>
                                </a>';
                        }
                        if($current_page<$i-1) {
                            $next_page = $current_page+1;
                        }else {
                            $next_page = $current_page;
                        }
                    ?>
                    <a href="?page=<?=$next_page?>" class="tag-a"><span><i class="fas fa-chevron-right shop-page2"></i></span> </a> 
                </div>
            </div>
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
    $('.filter-price').click(function() {
        alert('Hệ thống đang cập nhật tính năng này,vui lòng thử lại sau!')
    })
    //Lấy trang hiện tại ở url
    const page_get_url = document.querySelector('.page-now')
    const page_now = page_get_url.getAttribute('data-title')
    // Lấy trang ở phần số trang
    const page_footer = document.querySelectorAll('.page-footer span')
    for(let i=0;i<page_footer.length;i++) {
        // Lấy ra giá trị của số trang hiện tại
        const attrPageFooter = page_footer[i].getAttribute('data-prog')
        // So sánh trang lấy ra ở url và trang hiện tại ở footer
        if(page_now==attrPageFooter) {
            page_footer[i].classList.add('shop-page-now')
        }
    }
    
    
</script>
<?php
	require_once($baseUrl.'FE/layouts_FE/footer.php');
?>
<script src="<?=$baseUrl?>FE/js/cuahang.js"></script>
<script src="<?=$baseUrl?>FE/js/index.js"></script>
