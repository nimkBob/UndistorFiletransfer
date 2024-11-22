<?php

include 'Mysql.php';
include 'Check.php';
include 'User.php';


function login($username,$password,$zt){
  if(!(validate($username,20,6)) and !(validate($password,20,10))){
    exit();
  }
     if(isExist($username)){
       exit();
  }
  $feedbackvulae=new Sql;
  if($feedbackvulae->checkEquality($password,'password',$username,'username','user')){
    if($zt=='get'){
    return true;
   }
    $user=new User();
    $user->setloginin($feedbackvulae->getUserByUsername($username));
    feedback($user->getLoginUserInformation());
    return true;
  }else{
    $err=['err'=>'loginfailure'];
    feedback($err);
    exit();
  }
}

?>