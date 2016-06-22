<?php

namespace SON;

use PDO;

class Connection implements ConnectionInterface
{

    private $host;
    private $db;
    private $user;
    private $password;

    /**
     * @param string $host
     * @param string $db
     * @param string $user
     * @param string $password
     */
    public function __construct($host, $db, $user, $password)
    {
        $this->host     = $host;
        $this->db       = $db;
        $this->user     = $user;
        $this->password = $password;
    }

    /**
     * @return PDO
     */
    public function connect()
    {
        return new \PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->password);
    }
}

