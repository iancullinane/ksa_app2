<?php

class Core
{
    public $dbh; // handle of the db connexion
    private static $instance;

    private function __construct()
    {
        // building data source name from config
        $dsn = 'mysql:host=localhost' .
               ';dbname=ksa_two' .
               ';connect_timeout=15';
        // getting DB user from config                
        $user = 'eignh';
        // getting DB password from config                
        $password = '#mountain08';

        $this->dbh = new PDO($dsn, $user, $password);
    }

    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }

    // others global functions
}

?>