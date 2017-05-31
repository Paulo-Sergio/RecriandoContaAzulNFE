<?php

require './enviroment.php';

global $config;
$config = array();

if (ENVIROMENT == "development") {
    $config['dbname'] = 'contaazulnfe';
    $config['dbhost'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
} else {
    // $config para ambiente de produção
    $config['dbname'] = 'contaazulnfe';
    $config['dbhost'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
}