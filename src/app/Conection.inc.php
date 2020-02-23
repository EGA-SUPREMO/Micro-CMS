<?php
class Conection {
    
    private static $conection;

    public static function openConection() {
        if(!isset(self::$conection)) {
            try {
                include_once 'Config.inc.php';
                
                self::$conection = new PDO("mysql:host=". SVNAME ."; dbname=" . DBNAME, USERNAME, PASSWORD);
                //self::$conection -> setAttribute(PDO::ATRR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conection -> exec("SET CHARACTERSET utf8");
            } catch (PDOException $ex) {
                echo "ERROR" . $ex -> getMessage() . "<br>";
                die();
            }
        }
    }
    
    public static function closeConection() {
        if(isset(self::$conection))
            self::$conection = null;
    }
    
    public static function getConection() {
        return self::$conection;
    }
}