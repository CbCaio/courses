<?php

require_once "../vendor/autoload.php";
require_once "container-config.php";

$client = $container['client'];
$list   = $client->lists();

include("./table/clients_list.php");