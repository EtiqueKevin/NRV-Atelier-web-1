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

    'SECRET_KEY' => getenv('JWT_SECRET_KEY'),
    'DRIVER' => getenv('DRIVER'),
    'HOST' => getenv('HOST'),
    'PORT' => getenv('PORT'),
    'DATABASEUSER' => getenv('DATABASEUSER'),
    'DATABASESOIRREES' => getenv('DATABASESOIREES'),
    'USERNAME' => getenv('USERNAME'),
    'PASSWORD' => getenv('PASSWORD'),

    'soirees.pdo' => function( ContainerInterface $c) {
        $dsn = getenv('DRIVER') . ":host=" . getenv('HOST') . ";port=" . getenv('PORT') . ";dbname=" . getenv('DATABASESOIREES') . ";";
        $user = getenv('USERNAME');
        $password = getenv('PASSWORD');
        return new \PDO($dsn, $user, $password, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    },

    'utilisateurs.pdo' => function( ContainerInterface $c) {
        $dsn = getenv('DRIVER') . ":host=" . getenv('HOST') . ";port=" . getenv('PORT') . ";dbname=" . getenv('DATABASEUSER') . ";";
        $user = getenv('USERNAME');
        $password = getenv('PASSWORD');
        return new \PDO($dsn, $user, $password, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    },

    

    ];