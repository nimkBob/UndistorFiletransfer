<?php

class UniqueIDGenerator {
    private $lastTimestamp = 0;
    private $counter = 0;

    public function generateUniqueID() {
        $currentTimestamp = microtime(true) * 1000; // 获取当前时间戳（毫秒）

        // 如果当前时间戳与上次相同，则递增计数器
        if ($currentTimestamp == $this->lastTimestamp) {
            $this->counter++;
        } else {
            $this->counter = 0;
            $this->lastTimestamp = $currentTimestamp;
        }

        // 组合时间戳和计数器生成唯一ID
        $uniqueID = ($currentTimestamp << 22) | $this->counter;

        return (int) $uniqueID;
    }
}
     
function getfile(){
 include 'Feedback.php';
 include 'Check.php';
 include 'Login.php';
// 设置文件上传的目标目录
 $targetDir = "../userfile/";
// 检查目标目录是否存在，如果不存在则创建
 if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
 }


 // 验证    账号密码是否正确
  if(!(login( $_POST['username'],$_POST['password'],false)))
  {
    feedback('error:账密验证失败');
     exit;
  }


  
 
  if(!(checkFloderDownloadPower($_POST['targetFile'],$GLOBALS['user'][0]['id']))){
    feedback('error:无上传权限');
    exit;
}
  
  
  // 检查是否有文件通过POST请求上传
 if (isset($_FILES['uploadFile']) && $_FILES['uploadFile']['error'] == UPLOAD_ERR_OK) {
    $tmpName = $_FILES['uploadFile']['tmp_name'];
    $fileName = basename($_FILES['uploadFile']['name']);
    
    // 获取文件扩展名
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $newFileName = uniqid() . '.' . $fileExt; // 使用uniqid生成唯一文件名
        
    // 检查新文件名是否已经存在，虽然使用uniqid很少会重复，但这里还是做一个检查以确保万无一失
    while (file_exists($targetDir . $newFileName)) {
        $newFileName = uniqid() . '.' . $fileExt;
    }

    // 移动上传的文件到目标目录
    if (move_uploaded_file($tmpName, $targetDir . $newFileName)) {
        feedback("success:上传成功");
        $fileid=new UniqueIDGenerator();
        $FId=$fileid->generateUniqueID();
        include 'Mysql.php';
    } else {
        feedback("error:上传失败");
    }
 } else {
    feedback("error:没有上传文件");
 }
}
?>