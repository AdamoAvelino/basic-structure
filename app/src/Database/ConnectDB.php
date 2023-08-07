<?php

namespace App\src\Database;

use \PDO;

final class ConnectDB
{
    private static $conn;

    const OPTIONS = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];

    private function __construct() {}

    public static function open()
    {
          !self::$conn ? self::connect() : null;
          return self::$conn;
    }

    /**
     * ---------------------------------------------------------------------------------------------------------------------
     */
    public static function execute(String $query, Array $binds)
    {
        
        $stmt = self::$conn->prepare($query);
        if($stmt->execute($binds)) {
            return self::$conn;
        }
        return null;
    }
    
    /**
     * ---------------------------------------------------------------------------------------------------------------------
     */
    public static function query(String $query, Array $binds = [])
    {
        $stmt = self::$conn->prepare($query);
        $test = $stmt->execute($binds);
        return $stmt->fetchAll();
    } 


    public static function Transaction()
    {
        self::open();
        self::$conn->beginTransaction();

    }

    public static function commit()
    {
        self::open();
        self::$conn->commit();
    }

    public static function rollback()
    {
        self::open();
        self::$conn->rollback();
    }
    
    
    private static function connect()
    {
        try{
            $driver = env('DATABASE_DRIVER');
            $host = env('DATABASE_HOST');
            $base = env('DATABASE_NAME');
            $user = env('DATABASE_USER');
            $pass = env('DATABASE_PASS');
            self::$conn = new PDO("{$driver}:host={$host};dbname={$base}", $user, $pass, self::OPTIONS);
        } catch (\Exception $e) {
            dd($e);
        }
    }


}