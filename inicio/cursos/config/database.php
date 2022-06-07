<?php
class Database
{
    private $hostname = "localhost";
    private $database = "tfg";
    private $username = "root";
    private $password = "";
    private $charset = "utf8";
    function conectar()
    {
        try {
            $conexion = "mysql: dbname=". $this->database .";host=". $this->hostname .";charset=". $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
            $pdo = new PDO($conexion, $this->username, $this->password, $options);
            return $pdo;
        } catch (PDOException $e) {
            echo 'Error connection: ' . $e->getMessage();
        }
    }
}
