<?

include 'Mysql.php';
include 'check.php';


function login($username,$password,$hintbotten){
  if(!validate($username,20,6)and !validate($password,20,12)){
    exit;
  }

  if(!isExist($username)){
    exit;
  }

  include "Mysql.php";
  $feedbackvulae=new Sql();
  if($feedbackvulae->checkEquality($password,'password',$username,'username','user')){
    if($hintbotten==true){
    feedback("success:登入成功");
    }
    $feedbackvulae->getUserinformation($username,$password);
    return true;
  }else{
    feedback("error:登入失败");
    exit();
  }
}

?>