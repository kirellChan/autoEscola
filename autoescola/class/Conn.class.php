<?php
class Conn{
    //static - pertence a classe e nao a uma instancia dela
    public static $host = HOST;
    public static $user = USER;
    public static $pass = PASS;
    public static $dbname = DBNAME;

    private static $connect = null;

    private static function Conectar(){
        try {
            if(self::$connect == null):
                self::$connect = new PDO('mysql:host='.self::$host.';dbname='.self::$dbname,self::$user,self::$pass);
            endif;
        } catch (Exception $e) {
            echo "Mensagem: ".$e->getMessage();
            die;
        }
        return self::$connect;
    }
    function getConn(){
        return self::Conectar();
    }
}