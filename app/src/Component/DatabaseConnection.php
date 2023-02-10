<?php

namespace App\Component;

use PDO;


/**
 * Class DatabaseConnection
 */
class DatabaseConnection
{
    private PDO $dbh;

    /**
     * @param array $config
     */
    public function __construct(array $config) {
        $this->dbh = new PDO(
            "mysql:host={$config['host']}:{$config['port']};dbname={$config['database']}",
            $config['username'],
            $config['password']
        );
    }

    /**
     * @return PDO
     */
    public function getDbh(): PDO
    {
        return $this->dbh;
    }
}
