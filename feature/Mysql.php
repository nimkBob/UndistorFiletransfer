<?php
class Sql {
    // 数据库连接信息
    private $servername = "localhost";
    private $username = "ser0ulatqxpkoxv";
    private $password = "SAexP4Tc00";
    private $dbname = "ser0ulatqxpkoxv";
    private $conn;

    /**
     * 构造函数，创建数据库连接
     */
    public function __construct() {
        // 创建数据库连接
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        
        // 检查连接是否成功
        if ($this->conn->connect_error) {
            throw new Exception("Connection failed: " . $this->conn->connect_error);
        }
    }

    /**
     * 析构函数，关闭数据库连接
     */
    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    /**
     * 验证指定的值是否在表的特定列中存在
     *
     * @param mixed $value 需要验证的值
     * @param string $columnName 需要验证的列名
     * @param string $table 表名
     * @return bool 如果值存在返回true，不存在返回false
     */
    public function checkExistence($value, $columnName, $table) {
        // 使用预处理语句防止SQL注入
        $sql = "SELECT COUNT(*) as count FROM " . $this->conn->real_escape_string($table) . 
               " WHERE " . $this->conn->real_escape_string($columnName) . " = ?";
        
        // 准备SQL语句
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        
        // 绑定参数并执行
        $stmt->bind_param("s", $value);
        $stmt->execute();
        
        // 获取结果
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        // 关闭语句
        $stmt->close();
        
        // 返回是否存在（count > 0）
        return $row['count'] > 0;
    }


 public function checkEquality($testValue,$columnName,$noun,$noumName,$table) {
   $sql = 'SELECT '.$columnName.' FROM '.$table.' WHERE '.$noumName.'='.$noun;
   $result = $this->conn->query($sql);
   $row = $result->fetch_assoc();
   if($row[$columnName]==$testValue){
       return true;
   }
   else{
       return false;
   }
}

 public function checkFloderDownloadPower($targetId,$userId) {
   //检验用户是否有在该文件夹中上传的权限
   $sql = 'SELECT users,admins FROM Fdate WHERE id='.$targetId;
   $stmt = $this->conn->prepare($sql);
   if (!$stmt) {
    throw new Exception("Prepare failed: ". $this->conn->error);
}
    $stmt->bind_param('s', $targetId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $splitArray = explode(';',$row['users']);
    $splitArray2 = explode(';',$row['admins']);
    for($i=0;$i<count($splitArray);$i++){
      if($splitArray[$i]==$userId){
        for($j=0;$j<count($splitArray2);$j++){
          if($splitArray2[$j]==$userId){
            return true;
          }
        }
      }
    }
    return false;
}
public function  adduser($userinformation){
    //构建 sql 插入用户信息语句
    $sql="INSERT INTO user"." (username,password,name,main,membars,teams,teamposltion,friends,activity)"."VALUES"."("; 
    for($i=0;$i<9;$i++){
    $sql=$sql.$userinformation[$i].",";
    }
    $sql=$sql.")";
    //执行语句反馈结果    
    if($this->conn->query($sql)===TRUE){
      return true;
    }else{
     return false;
    }
}
 public function getUserinformation($username,$password){
    $sql= 'SELECT * FROM user WHERE username='.$username.'AND password='.$password;
    $stmt = $this->conn->prepare($sql);   
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $GLOBALS['user'][]=$row;
}

 public function addFate(){}
}
?>