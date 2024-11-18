<<?php

include 'Mysql.php';
include 'Check.php';


function login($username,$password,$hintbotten){
  
  if(!(validate($username,20,6)) and !(validate($password,20,10))){
    exit();
  }
     if(isExist($username)){
       exit();
  }
  $feedbackvulae=new Sql;
  if($feedbackvulae->checkEquality($password,'password',$username,'username','user')){
    if($hintbotten=='treu'){
    feedback("success:登入成功");
    }
    $feedbackvulae->getLoginuserinformation($username,$password);
    return true;
  }else{
    feedback("error:登入失败");
    exit();
  }
}

?>