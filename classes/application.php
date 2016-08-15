<?php

class Application {

    protected static $db;
    protected static $config;

    public static function getConfig(){
        return self::$config;
    }
    public static function getDB(){
        if (is_null(self::$db)) {
            try {
                self::$db = new PDO('mysql:host=' . self::$config['DB_HOST'] . ';dbname=' . self::$config['DB_NAME'], self::$config['DB_USER'], self::$config['DB_PASS']);
                self::$db->exec('SET CHARACTER SET utf8');
                self::$db->exec('SET NAMES utf8');
            }
            catch (Exception $e) {
                 echo $e->getMessage();; // TODO добавить красивый вывод
            }

        }
        return self::$db;
    }
    public static function setConfig($config){
        self::$config = $config;
    }

}
