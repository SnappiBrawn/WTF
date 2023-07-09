<?php
class DB {

    private static $host = "localhost";
    private static $database = "fiesta_db";
    private static $username = "root";
    private static $password = "";
    
    public static function getConnection() {
        $connection = mysqli_connect(DB::$host, DB::$username, DB::$password, DB::$database);

        
        //$dsn = 'mysql:host=' . DB::$host . ';dbname=' . DB::$database;
        //$connection = new PDO($dsn, DB::$username, DB::$password);
        //$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;
    }

}