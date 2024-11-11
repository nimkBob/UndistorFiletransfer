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
    if($hintbotten=="true"){
    feedback("success:Login-successful");
    }
    exit;
  }else{
    feedback("error:Incorrect-password");
    exit;
  }
}

?>