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

    /**
     * 验证指定的值是否在表的特定行中存在
     * 注意：这个方法实际上与valueExistsInColumn相同，因为在数据库中，"行"通常指的是记录，而不是列
     *
     * @param mixed $value 需要验证的值
     * @param string $columnName 需要验证的列名
     * @param string $table 表名
     * @return bool 如果值存在返回true，不存在返回false
     */
    public function valueExistsInRow($value, $columnName, $table) {
        // 直接调用valueExistsInColumn方法，因为功能相同
        return $this->valueExistsInColumn($value, $columnName, $table);
    }
}
?>