<?php
class Sql {
    // 数据库连接信息
    private $servername = "localhost";
    private $username = "your_username";
    private $password = "your_password";
    private $dbname = "your_database";
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
    public function valueExistsInColumn($value, $columnName, $table) {
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


    
    function getRowValuesByUserName($tableName, $columnName, $userName) {
      // 假设 $this->conn 是已经建立好的数据库连接
      $conn = $this->conn;
  
      // 构建SQL查询语句
      $sql = "SELECT * FROM $tableName WHERE $columnName = ?";
      
      // 预处理SQL语句
      $stmt = $conn->prepare($sql);
  
      // 绑定参数
      $stmt->bind_param("s", $userName);
  
      // 执行查询
      $stmt->execute();
  
      // 获取结果
      $result = $stmt->get_result();
  
      // 检查是否有结果
      if ($result->num_rows > 0) {
          // 获取指定行的数据
          $row = $result->fetch_assoc();
          return $row;
      } else {
          return null; // 没有找到匹配的行
      }
  
      // 关闭预处理语句
      $stmt->close();
  }
}


?>