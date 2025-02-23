<?php
class Database
{
  private $servername = 'localhost';
  private $database = 'converse';
  private $username = 'root';
  private $password = '';
  private $charset = "utf8mb4";
  private $pdo;

  public function __construct()
  {
    try {
      $dsn = "mysql:host=$this->servername;dbname=$this->database;charset=$this->charset";
      $this->pdo = new PDO($dsn, $this->username, $this->password);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  public function fetchColumn($sql)
  {
    $param = array_slice(func_get_args(), 1);
    $stmt = $this->query($sql, $param);
    return $stmt->fetchColumn();
  }

  public function getPdo()
  {
    return $this->pdo;
  }

  public function query($sql, $param = [])
  {
    $stmt = $this->pdo->prepare($sql);
    if ($param) {
      $stmt->execute($param);
    } else {
      $stmt->execute();
    }
    return $stmt;
  }

  public function getAll($sql, $param = [])
  {
    $stmt = $this->query($sql, $param);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getOne($sql, $param = [])
  {
    $stmt = $this->query($sql, $param);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function insert($sql, $param = [])
  {
    $this->query($sql, $param);
    return $this->pdo->lastInsertId();
  }

  public function update($sql, $param = [])
  {
    $stmt = $this->query($sql, $param);
    return $stmt->rowCount();
  }

  public function delete($sql, $param = [])
  {
    $stmt = $this->query($sql, $param);
    return $stmt->rowCount();
  }

  // Các phương thức hỗ trợ transaction
  public function beginTransaction()
  {
    return $this->pdo->beginTransaction();
  }

  public function commit()
  {
    return $this->pdo->commit();
  }

  public function rollBack()
  {
    return $this->pdo->rollBack();
  }

  public function __destruct()
  {
    unset($this->pdo);
  }
}

