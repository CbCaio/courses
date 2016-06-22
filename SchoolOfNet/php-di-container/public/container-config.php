<?php

$container = new Pimple\Container();

$container['host']     = 'localhost';
$container['db']       = 'diservice';
$container['user']     = 'homestead';
$container['password'] = 'secret';

$container['connection'] = function ($c) { // receives the container itself as argument
    return new \SON\Connection(
        $c['host'],
        $c['db'],
        $c['user'],
        $c['password']
    );
};

$container['client'] = function ($c) {
    return new \SON\Client($c['connection']);
};