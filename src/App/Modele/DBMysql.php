<?php

namespace App\Modele;

use App\Modele\DatabaseInterface;

class DBMysql implements DatabaseInterface
{
    const DB_HOST = '127.0.0.1';
    const DB_NAME = 'chat';
    const DB_USER = 'root';
    const DB_PASSWORD = '';

    public function connect()
    {
        $con = @mysqli_connect(
            self::DB_HOST,
            self::DB_USER,
            self::DB_PASSWORD,
            self::DB_NAME
        );

        if ($con === false) {
            throw new \Exception('Try to connect database. Please check your configuration.');
        }

        mysqli_set_charset($con , 'UTF-8');

        return $con;
    }
}
