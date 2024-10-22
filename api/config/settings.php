<?php

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Container\ContainerInterface;

return  [
    'displayErrorDetails' => true,
    'logs.dir' => __DIR__ . '/../var/logs',
    'logs.name' => 'nrv.log',
    'logs.level' => Level::Info,

    'logger' => function( ContainerInterface $c) {
        $log = new Logger( $c->get('logs.name'));
        $log->pushHandler(
            new StreamHandler($c->get('logs.dir'),
                $c->get('logs.level')));
        return $log;
    },

    'soirees.pdo' => function( ContainerInterface $c) {
        $config = parse_ini_file('iniconf/soirees.ini');
        $dsn = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['database']};";
        $user = $config['username'];
        $password = $config['password'];
        return new \PDO($dsn, $user, $password, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    },

    'utilisateurs.pdo' => function( ContainerInterface $c) {
    $config = parse_ini_file('iniconf/utilisateurs.ini');
    $dsn = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['database']};";
    $user = $config['username'];
    $password = $config['password'];
    return new \PDO($dsn, $user, $password, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
}

    ];