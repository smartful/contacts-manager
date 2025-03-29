<?php
if (!defined('ROOT')) {
    define('ROOT', dirname(__DIR__));
}
$config = parse_ini_file(ROOT . '/.env');

//On se connecte au SGBD Mysql
try {
    $bdd = new PDO("mysql:host={$config['DB_HOST']};dbname={$config['DB_NAME']}", $config['DB_USER'], $config['DB_PASS']);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $error) {
    die('Error :'.$error->getMessage());
}