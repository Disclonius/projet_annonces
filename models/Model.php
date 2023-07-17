<?php

abstract class Model
{
    private const HOST = 'localhost';
    private const DB = 'projet_annonces';
    private const USER = 'root';
    private const PWD = '';

    protected static $database;

    protected static function initDatabase()
    {
        $dsn = 'mysql:host=' . self::HOST . ';dbname=' . self::DB . ';charset=utf8mb4';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ];

        try {
            self::$database = new PDO($dsn, self::USER, self::PWD, $options);
        } catch (PDOException $e) {
            throw new Exception('Failed to connect to the database: ' . $e->getMessage());
        }
    }

    protected function getDatabase()
    {
        if (self::$database === null) {
            self::initDatabase();
        }
        return self::$database;
    }
}

?>
