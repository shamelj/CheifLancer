<?php
class Database{
    private const HOST="localhost";
    private const USER="signed_user";
    private const PASSWORD="4738";
    private const DB_NAME="cheiflancer";
    private const DSN="mysql:host=".self::HOST.";dbname=".self::DB_NAME;
    private static $conn=null;
 

    private function __construct() {}
    
    public static function getConnection():PDO{
        if(is_null(self::$conn)){
            
        try{
            self::$conn=new PDO(self::DSN,self::USER,self::PASSWORD);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e){
                echo $e->getMessage();
            }
        }catch(Exception $e){
            return false;
        }

        return self::$conn;
    }
}