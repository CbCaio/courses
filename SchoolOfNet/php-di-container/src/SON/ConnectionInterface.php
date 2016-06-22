<?php

namespace SON;

use PDO;

interface ConnectionInterface
{
    /**
     * @return PDO
     */
    public function connect();
}