<?php

namespace config;

class database 
{

    private static $db = [
        'host' => 'localhost',
        'dbname' => 'nuxt',
        'user' => 'root',
        'password' => '1234',
        'port' => '3306' 
    ];

    private static $connection = null;

    private function __construct() {

    }

    public static function pdoConnection() {

        $db = self::$db;

        try {
            self::$connection = new \PDO("mysql:host={$db['host']};dbname={$db['dbname']}", $db['user'], $db['password']);
        } catch(\PDOException $e) {
            return die($e->getMessage());
        }

        return self::$connection;
    }

}