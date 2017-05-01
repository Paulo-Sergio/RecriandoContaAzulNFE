<?php

require './enviroment.php';

global $config;
$config = array();

if (ENVIROMENT == "development") {
    $config['dbname'] = 'contaazul';
    $config['dbhost'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
} else {
    // $config para ambiente de produção
    $config['dbname'] = 'contaazul';
    $config['dbhost'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
}