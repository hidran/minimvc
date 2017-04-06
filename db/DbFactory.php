<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DB;
use App\DB\DBPDO;
/**
 * Description of DbFactory
 *
 * @author Elio
 */
class DbFactory {
    
    public static function create(array $options){
        if(!array_key_exists('charset', $options)){
            $options['charset'] = 'utf8';
        }
        if(!array_key_exists('dsn', $options)){
        if(!array_key_exists('driver', $options)){
            throw new \InvalidArgumentException('Nessun driver predefinito');
        }
        $dsn = '';
        switch($options['driver']){
            case 'mysql':
            case 'oracle':
            case 'mssql':
                $dsn = $options['driver'].':host='.$options['host'];
                $dsn .= ';dbname='.$options['database'].';charset='.$options['charset'];
                break;
            case 'sqlite':
                $dsn = 'sqlite:'.$options['database'];
                break;
            default :
                throw new \InvalidArgumentException('Driver non impostato o sconosciuto');
        }
        $options['dsn'] = $dsn;
        }
        return DBPDO::getInstance($options);
    }
}
