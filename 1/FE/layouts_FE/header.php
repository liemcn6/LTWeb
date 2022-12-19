<?php
    $baseURL ='';
    ob_start();
    session_start();
    require_once ($baseUrl.'utils/ulitity.php');
    require_once ($baseUrl.'database/dbhelper.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- <link rel="stylesheet" href="../css/main.css"> -->
    <link rel="stylesheet" href="<?=$baseUrl?>FE/layouts_FE/css/main.css">
    <link rel="stylesheet" href="<?=$baseUrl?>FE/layouts_FE/css/grid.css">
    <link rel="stylesheet" href="<?=$baseUrl?>FE/layouts_FE/css/home.css">
    <link rel="icon" href="https://tonycongmmo.com/wp-content/uploads/2020/09/cropped-landingpage-clean-studio-logo-4-flatsome-theme-uxbuilder-32x32.png" sizes="32x32" />
    <link rel="icon" href="https://tonycongmmo.com/wp-content/uploads/2020/09/cropped-landingpage-clean-studio-logo-4-flatsome-theme-uxbuilder-192x192.png" sizes="192x192" />
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title><?=$title?></title>
</head>
<style>
    
</style>
<body>
    <div class="wrapper">
        <header class="header">
            <div class="header-wrapper">
                <div class="top-bar">
                    <div class="grid wide header-topbar">
                        <div class="header-sale" id= "sale">
                            <span>NHẬP MÃ VTL ĐỂ GIẢM 10%</span>
                        </div>
                        <div class="header-social">
                            <div class="header-social-phone header-social-phone-sdt">
                                <div class="header-social-phone-box">
                                    <i class="fas fa-phone-alt"></i>
                                    <a href="tel: 0378208856" class="header-phone-number tag-a">0378208856</a>
                                </div>
                                <div class="header-social-hover">
                                    <span>0378208856</span>
                                    <div class="hover-square"></div>
                                </div>
                            </div>
                            <div class="header-social-phone header-social-fb header-fb-hover">
                                <div class="header-social-phone-box ">
                                    <a href="" class="tag-a header-social-fb-icon"><i class="fab fa-facebook-f"></i></a>
                                </div>
                                <div class="header-social-hover header-social-hover-fb">
                                    <span>Follow on Facebook</span>
                                    <div class="hover-square"></div>
                                </div>
                            </div>
                            <div class="header-social-phone header-social-fb header-fb-ig" >
                                <div class="header-social-phone-box ">
                                    <a href="" class="tag-a header-social-ig-icon"><i class="fab fa-instagram"></i></a>
                                </div>
                                <div class="header-social-hover header-social-hover-fb">
                                    <span>Follow on Instagam</span>
                                    <div class="hover-square"></div>
                                </div>
                            </div>
                            <div class="header-social-phone header-social-fb header-fb-tw" style="">
                                <div class="header-social-phone-box ">
                                    <a href="" class="tag-a header-social-ig-icon"><i class="fab fa-twitter"></i></a>
                                </div>
                                <div class="header-social-hover header-social-hover-fb">
                                    <span>Follow on Twitter</span>
                                    <div class="hover-square"></div>
                                </div>
                            </div>
                            <div class="header-social-phone header-social-fb header-fb-yt" >
                                <div class="header-social-phone-box ">
                                    <a href="" class="tag-a header-social-yt-icon"><i class="fab fa-youtube"></i></i></a>
                                </div>
                                <div class="header-social-hover header-social-hover-fb" >
                                    <span>Follow on Youtube</span>
                                    <div class="hover-square"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="masthead">
                    <div class="grid wide header-masthread">
                        <label for= "nav-mobile-input" class="icon-bar-mobile">
                            <i class="fas fa-bars"></i>
                        </label>
                        <!-- Logo -->
                        <div class="logo">
                            <a href="<?=$baseUrl?>">
                                <img src="<?=$baseUrl?>FE/img/logo1.png" alt="" class="logo-img">
                            </a>
                        </div>
                        <!-- TÌm kiếm -->
                        <div class="masthead-search">
                            <div class="masthead-search-box">
                                <form action="" class="header-search-form">
                                    <input type="text" placeholder="Tìm kiếm điện thoại, laptop" class="header-search-input">
                                    <button type="submit" class="header-search-icon">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="masthead-right">
                            <div class="masthead-right-box">
                            <!-- Giỏ hàng -->
                            <?php
                                include_once $baseUrl.'FE/giohang/giohang.php';
                            ?>
                            <!-- Đăng kí -->
                            <?php
                                if(isset($_SESSION['email'])) {
                                    $email = $_SESSION['email'];
                                    $sql = "SELECT * FROM user WHERE email = '$email'";
                                    $data = executeResult($sql,true);
                                    echo '
                                    <div class="user">
                                        <div class="user_name">
                                            <span class="" >'.$data['fullname'].'</span>
                                            <i class="fas fa-caret-down"></i>
                                        </div>
                                        <div class="infor_user">
                                            <a href="" class="tag-a infor-account"><span>Thông tin tài khoản</span></a>
                                            <a href="'.$baseUrl.'detail" class="tag-a logout"><span>Thông tin đơn hàng</span></a>
                                            <a href="'.$baseUrl.'authen/logout.php" class="tag-a logout"><span>Đăng xuất</span></a>
                                        </div>
                                    </div>
                                    ';
                                }else {
                                    include_once $baseUrl.'authen/dangki.php';
                                    include_once $baseUrl.'authen/dangnhap.php';
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                    <?php
                        include_once 'category/danhmuc.php';
                    ?>
                </div>
            </div>
        </header>
    </div>
</html>
