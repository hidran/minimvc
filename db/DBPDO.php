<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DB;

/**
 * Description of DBPDO
 *
 * @author Elio
 */
class DBPDO {
    protected $conn;
    protected static $instance;
    public static function getInstance(array $options)
    {
        if(!self::$instance){
            self::$instance = new static ($options);
        }
        return static::$instance;
    }
    
    protected function __construct(array $options) {
        $this->conn = new \PDO($options['dsn'], $options['user'], $options['password'], $options['pdooptions']);
    }
    
    public function getConn(){
        return $this->conn;
    }
    
}
