<?php
 class Database
 {
    //estrutura do banco de dados: meu_banco, users->id, email, nome
     private $host = 'localhost';
     private $dbName = 'meu_banco';
     private $username = 'root';
     private $password = '';
     private $conn;
 
     public function getConnection()
     {
         if ($this->conn === null) {
             try {
                 $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->username, $this->password);
                 $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             } catch (PDOException $e) {
                 echo 'Connection failed: ' . $e->getMessage();
                 exit();
             }
         }
         return $this->conn;
     }
 }

?>

