<?php
function post($data) {
    // 抑制包含文件时的错误输出
    @include 'Check.php';
    @include 'Mysql.php';
    @include 'User.php';
   $userInfo = [
        $data['username'],
        $data['password'],
        $data['name'],
        $data['main'],
        $data['membars'],
        $data['usertype'],
    ];
    // 检查用户名和密码的合法性
   if (!(validate($userInfo[0], 20, 6)  && validate($userInfo[1], 20, 10))) {
        exit();  
    }
    $user = new User;
    $user->setSignup($userInfo);
    $num = $user->getSginuserinformation();
    unset($user);
    $mysqlHandler = new Sql;
    if ($mysqlHandler->adduser($num)) {
        feedback('success: Signup successful');
    } else {
        feedback('error:Signup failed'); 
    }
}
?>

