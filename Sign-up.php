<?php
class User{
    
}

function feedback($type){
  $feedback=['feedbackstate'=>$type];
  header('Content-Type:application/json');
  echo json_encode($feedback);
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

 function validate(){
  
  if(!(isAlphanumeric($_POST['name']))){
    feedback("error:The-named-name-contains-illegal-characters");
    return false;
 }
  if(isAlphanumeric($_POST['password'])){
    feedback("error:The-enter-password-contains-illegal-chracters");
    return false;
  }
  if(strlen($_POST['password'])<8 || strlen($_POST['name']<6)){
    feedback("error:The-name-or-password-was-so-short");
    return false;
  }

}
?>