<?php

class ConexaoDB
{
    private $pdo;
    
    public function __construct($dsn, $dbname, $user, $pass)
    {
        try {
            $this->pdo = new \PDO($dsn, $user, $pass, array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ));
            $this->pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
            $this->pdo->exec("USE $dbname");
        } catch (\PDOException $ex) {
            echo "Conexão Falhou: " . $ex->getMessage();
        }
    }
    
    public function getConnection()
    {
        return $this->pdo;
    }
}

    

