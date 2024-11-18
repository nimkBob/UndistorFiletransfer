<?php
 function isAlphanumeric($str){
    for($i=0;$i<strlen($str);$i++){
        $char=$str[$i];
        if(!(ctype_alnum($char))){
            return false;
        }
    }
    return true;
 }

 function validate($value,$maxlen,$minlen){//检验用户上传数据的合法性
    //注册验证用户的输入是否合法
    if(!(isAlphanumeric($value)) and $value==null){
      feedback("error: invalid value");
      return false;
   }
    if(strlen($value)>$maxlen || strlen($value)<$minlen){
      feedback("error:length-error");
      return false;
    }
    return true;
  }

  function isExist($name){
    //检测该用户账号是否已存在
    include "Mysql.php";
    $feedbackValue = new Sql();
    if($feedbackValue->checkExistence($name, 'username', 'user')){
      feedback("error:The-named-user-already-exists");
      return false;
    }
    return true;
  }

  function checkFloderDownloadPower($targetFileId,$userId){
    include 'Mysql.php'; 
    $feedbackValue = new Sql();
    if(!($feedbackValue->checkFloderDownloadPower($targetFileId, $userId))){
        return false;
  }
  return true;
}
?>