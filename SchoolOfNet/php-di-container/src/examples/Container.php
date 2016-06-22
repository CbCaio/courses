<?php

use SON\Client;
use SON\Connection;

class Container
{
    /**
     * @return Client
     */
    public static function getClient()
    {
        $client = new Client(self::getConnection());
        return $client;
    }

    /**
     * @return Connection
     */
    public static function getConnection()
    {
        $connection = new Connection();
        return $connection;
    }
}

