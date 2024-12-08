<?php
require __DIR__ . '/../app/helpers.php';
class Database{
    private static $instance=null;
    private $conn;
    public function __construct(){
        $config=require base_path('config/config.php');
        $dbconfig= config('database.host');
        $host=config('database.host');
        $database=config('database.name');
        $username=config('database.username');
        $password=config('database.password');
        $port=config('database.port');
        $charset=config('database.charset');
        

        $dsn="mysql:host=$host;dbname=$database;port=$port;charset=$charset";
        try{
            $this->conn = new PDO($dsn,$username,$password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die("Connection failed: " . $e->getMessage());
        }
    }
    public static function getInstance(){
        if(self::$instance==null){
            self::$instance=new Database();
        }
        return self::$instance;
    }
    public function getConnection(){
        return $this->conn;
    }


}
