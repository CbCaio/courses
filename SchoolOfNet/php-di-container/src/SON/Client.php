<?php

namespace SON;

class Client
{
    private $db;

    /**
     * @param ConnectionInterface $connection
     */
    public function __construct(ConnectionInterface $connection)
    {
        $this->db   = $connection->connect();
    }

    /**
     * @return array
     */
    public function lists()
    {
        $query     = "Select * from clients";
        $statement = $this->db->prepare($query);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}