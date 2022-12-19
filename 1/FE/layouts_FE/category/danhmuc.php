<?php 
    $title = 'Trang chủ';
?>
<input type="checkbox"  name="" class="nav__input" id="nav-mobile-input" hidden>
<label for= "nav-mobile-input" class="nav__overlay"></label>

<div class="wide-nav">
        <label for= "nav-mobile-input" class="close__overlay">
            <i class="fas fa-times"></i>
        </label>
    <div class="wide-nav-box">
        <?php
            if(isset($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $sql = "SELECT * FROM user WHERE email = '$email'";
                $data = executeResult($sql,true);
                echo '
                <div class="user__mobile">
                    <div class="user_name__mobile">
                        <span class="" >'.$data['fullname'].'</span>
                    </div>
                    
                </div>
                
                ';
            }
        ?>
        <div class="masthead-search-mobile">
            <div class="masthead-search-box">
                <form action="" class="header-search-form">
                    <input type="text" placeholder="Tìm kiếm điện thoại, laptop" class="header-search-input">
                    <button type="submit" class="header-search-icon">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
        <ul class="wide-nav-ul">
        
            <?php
                require_once ($baseUrl.'utils/ulitity.php');
                require_once ($baseUrl.'database/dbhelper.php');
                require_once ($baseUrl.'FE/convert_tv.php');
                $sql = 'SELECT * FROM category';
                $data = executeResult($sql);
                foreach ($data as $item) {
                    $str = $item['name'];
                    $str = vn_to_str($str);
                    if ($str=='trangchu') {
                        $href = $baseUrl;
                    } else {
                        $href = $baseUrl.'category/'.$str.'/?page=1';
                    }
                    echo '
                    <li class="wide-nav-items  tag-li">
                        <a href="'.$href.'" class="tag-a">    
                            <span class="wide-nav-items-span danhmuc-'.$str.'" style="text-transform: uppercase;">'.$item['name'].'</span>
                        </a>
                    </li>
                    ';
                }
                if(isset($_SESSION['email'])) {
                    echo '
                    <li class="wide-nav-items infor-user__mobile">
                        <span class="wide-nav-items-span">
                            <a href="'.$baseUrl.'authen/logout.php" class="tag-a logout"><span>Đăng xuất</span></a>
                        </span>
                    </li>';
                }else {
                    include_once $baseUrl.'authen/dangnhap_mobile.php';
                }
            ?>
        </ul>
    </div>
</div>
