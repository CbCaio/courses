<?php

use SON\ConnectionInterface;

class ConnectionDSN implements ConnectionInterface
{
    private $dsn;
    private $user;
    private $password;

    /**
     * @param $dsn
     */
    public function __construct($dsn, $user, $password)
    {
        $this->dsn      = $dsn;
        $this->user     = $user;
        $this->password = $password;
    }

    /**
     * @return PDO
     */
    public function connect()
    {
        return new \PDO($this->dsn, $this->user, $this->password);
    }
}

