<?php

namespace App;

use PDO;

final class Database
{
    // Cotacyt
    // private $host   = 'plataforma.cotacyt.gob.mx';
    // private $user   = 'innovacion';
    // private $pass   = 'W4HndVUhHBcZ343Z';
    // private $db     = 'sistema_evaluacion';

    // ACM
    private $host   = 'mante.hosting.acm.org';
    private $user   = 'mantehostingacm_kt';
    private $pass   = 'QWERTYKtdral_014';
    private $db     = 'mantehostingacm_CotacytXXI';

    public function connect(): PDO
    {
        $connectionString = "mysql:host=$this->host;dbname=$this->db;charset=utf8mb4;";
        $dbConnection = new PDO(
            $connectionString, 
            $this->user, 
            $this->pass, 
            array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
        );
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }
}
