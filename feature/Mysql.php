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


public function checkEquality($testValue, $columnName, $noun, $noumName, $table) {
    // 准备SQL语句
    $stmt = $this->conn->prepare("SELECT $columnName FROM $table WHERE $noumName = ?");
    
    // 绑定字符串参数
    $stmt->bind_param('s', $noun);

    // 执行查询
    $stmt->execute();

    // 获取结果集
    $result = $stmt->get_result();
  
    // 检查结果
    if ($result) {
        $row = $result->fetch_assoc();
        if ($row && isset($row[$columnName]) && $row[$columnName] == $testValue) {
            return true;          
    }
    }
    return false;
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

public function adduser($userinformation) {
        // 准备SQL插入语句
        $sql = "INSERT INTO user (username, password, name, main, membars, teams, teamposltion, friends, activity,usertype,id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // 准备预处理语句
        $stmt = $this->conn->prepare($sql);
        
        if (!$stmt) {
            // 如果预处理语句准备失败，返回错误信息
            feedback($this->conn->error);
        }

        // 绑定参数
        $params = [
            $userinformation[0],
            $userinformation[1],
            $userinformation[2],
            $userinformation[3],
            $userinformation[4],
            $userinformation[5],
            $userinformation[6],
            $userinformation[7],
            $userinformation[8],
            $userinformation[9],
            $userinformation[10],
        ];

        // 使用call_user_func_array绑定参数
        $types = str_repeat('s', count($params));
        call_user_func_array([$stmt, 'bind_param'], array_merge([$types], $params));

        // 执行预处理语句
        if ($stmt->execute()) {
            return true;
        } else {
            // 获取更详细的错误信息
            return false;
        }
}

public function getLastUserId() {
    // 查询 user 表中的最大 id
    $sql = "SELECT MAX(id) AS last_id FROM user";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // 输出数据
      $row = $result->fetch_assoc();
      return $row['last_id'];
    } else {
      return null;
    }

    // 关闭连
  }

  public function getUserByUsername($username) {
    // 构建 SQL 查询语句
    $sql = "SELECT username, password, name, main, membars,usertype, teams, teamposltion, activity, friends, id ,userfile FROM user WHERE username = ?";

    // 准备 SQL 语句
    $stmt = $this->conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $this->conn->error);
    }

    // 绑定参数并执行
    $stmt->bind_param("s", $username);
    $stmt->execute();

    // 获取结果
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // 关闭语句
    $stmt->close();

    // 如果没有找到用户，返回空数组
    if (!$row) {
        return [];
    }

    // 构造返回数组
    $userInformation = [
        $row['username'],
        $row['password'],
        $row['name'],
        $row['main'],
        $row['membars'], // 假设 usertype 列可能存在
        $row['usertype'],
        $row['teamposltion'],
        $row['activity'],
        $row['teams'],
        $row['friends'],
        $row['id'],
        $row['userfile'], 
    ];

    return $userInformation;
}

 public function addFate(){}
}
?>