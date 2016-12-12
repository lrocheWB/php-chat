<?php

namespace App\Modele;

interface DatabaseInterface
{
    /**
     * Try to connect database
     */
    public function connect();
}
