<?php

namespace App\Modele;

class DBFactory
{
    public static function create($connectionString)
    {
        switch ($connectionString){
            case 'mysql':
               $db = new DBMySql($connectionString1);
               break;
            default:
               throw new \Exception('Database not supported !');
        }

        return $db;
    }
}
