<?php
namespace App;

class Singleton{
    private static $instances=[];
    protected function __construct(){}
    protected function __clone(){}
    public function __wakeup(){
        throw new \Exception("Can't be Unserialize");
    }
    public static function getInstance(){
        $subclas=static::class;
        if(!isset(self::$instances[$subclas])){
            self::$instances[$subclas]=new static();
        }
        return self::$instances[$subclas];
    }
}