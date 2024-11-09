<?php
isExist("admin");
class User{
}


function feedback($type){
  $feedback=['feedbackstate'=>$type];
  header('Content-Type:application/json');
  echo json_encode($feedback);
  exit();
}
function isAlphanumeric($str){
    for($i=0;$i<strlen($str);$i++){
        $char=$str[$i];
        if(!(ctype_alnum($char))){
            return false;
        }
    }
    return true;
 }

 function validate($name,$password){//检验用户上传数据的合法性
  
  if(!(isAlphanumeric($name))){
    feedback("error:The-named-name-contains-illegal-characters");
    return false;
 }
  if(isAlphanumeric($password)){
    feedback("error:The-enter-password-contains-illegal-chracters");
    return false;
  }
  if(strlen($password)<8 || strlen($name<6)){
    feedback("error:The-name-or-password-was-so-short");
    return false;
  }
  return true;
}

 function isExist($name){
  $feedbackValue = new Sql();
  if($feedbackValue->valueExistsInColumn($name, 'username', 'user')){
    feedback("error:The-named-user-already-exists");
    return false;
  }
  return true;
}

?>