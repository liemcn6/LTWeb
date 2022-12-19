<?php 
$fullname = $email = $msg = '';
if(!empty($_POST)) {
    $fullname = getPost('fullname');
    $email = getPost('email');
    $pwd = getPost('password');
    if(empty($fullname) || empty($email) || empty($pwd) || strlen($pwd) <6) {
    } else {
        // $sql = "SELECT * FROM user WHERE email = '$email'";
        $userExist = executeResult("SELECT * FROM user WHERE email = '$email'",true);
        if($userExist != null) {
            $msg = '*Email đã được đăng ký,vui lòng đăng ký lại';
            // echo $msg;
        } else {
            $created_at = $updated_at = date('Y-m-d H:i:s');

            $sql = "INSERT INTO user (fullname,email,password,role_id,created_at,updated_at,deleted) 
                              VALUES ('$fullname','$email','$pwd',2,'$created_at','$updated_at',0)";
           execute($sql);
            header('Location: ../login');
            die();
        }
    }
}
