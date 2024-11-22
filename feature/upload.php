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
     

function getfile($data){
 include 'Feedback.php';
 include 'Check.php';
 include 'Login.php';
 include 'Fdate.php';
 include 'Datatype.php';
 /*
 * 获取上传的文件
 * @param array $data 包含以下键：
 *   - 'file_content' (string)：Base64 编码后的上传文件内容
 *   - 'filename' (string)：上传的文件名
 *   - 'file_ext' (string)：上传文件的扩展名
 *   - 'targetFile' (string)：需要下载的文件名
 *   - 'id' (int)：需要下载的用户 ID
 *   - 'username' (string)：上传者的用户名
 *   - 'password' (string)：上传者的密码
 * {
 * 'username':
 * 'password':
 * 'userid':
 * 'targetid':
 * 'filename':
 * 'file_ext':
 * 'file_content':
 * 'endtime':
 * 'hintinformation':
 * }
 * @return void
 */

// 引入所需函数
/// 设置文件上传的目标目录
 $targetDir = "../userfile/";
// 检查目标目录是否存在，如果不存在则创建
 if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
 }


 // 验证    账号密码是否正确
  if(!(login( $data['username'],$data['password'],'get')))
  {
    feedback('error:账密验证失败');
     exit;
  }


  
 
  if(!(checkFloderDownloadPower($data['targetid'],$data['userid']))){
    feedback('error:无上传权限');
    exit;
}
  
  
  // 检查是否有文件通过POST请求上传
  if (isset($data['file_content'])) {
    // 解码Base64字符串
    $file_content = base64_decode($data['file_content']);

    // 获取文件名和扩展名
    $fileName = $data['filename'];
    $fileExt = $data['file_ext'];
    // 检查新文件名是否已经存在，虽然使用uniqid很少会重复，但这里还是做一个检查以确保万无一失
    while (file_exists($targetDir . $newFileName)) {
        $newFileName = uniqid() . '.' . $fileExt;
    }

    // 移动上传的文件到目标目录
    if (file_put_contents($targetDir . $newFileName, $file_content) !== false) {
        $fileid=new UniqueIDGenerator();
        $FId=$fileid->generateUniqueID();
        unset($fileid);


        $sql=new Sql;
        $id=$sql->getMaxIdFromFdata();
        $endtime=convertToDateTime($data['endtime']);
        $information=['id'=>$id+1,'filename'=>$fileName,'admin'=>$data['userid'],'sonfile'=>'','user'=>'','files'=>$newFileName.';','hintinformation'=>$data['hintinformation'],'endtime'=>$endtime];
        $file=new Fdate();
        $file->setFile($information);
        if($sql->addFile($file->getFileInfo())) {
            unset($file);
            if($sql->setTargetFdata($data['targetid'],$id)){
                $err=['success:'=>'添加成功'];
                unset($sql);
                feedback($err);
            }
            else{
                $err=['error'=>"添加失败"];
                unset($sql);
                feedback($err);
            }
        }else{
            $err=['error'=>"数据库插入失败"];
            unset($sql);
            feedback($err);
        }
    } else {
        feedback("error:上传失败");
    }
 } else {
    feedback("error:没有上传文件");
 }
}