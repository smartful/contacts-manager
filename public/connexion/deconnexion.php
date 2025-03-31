<?php
if (!defined('ROOT')) {
    define('ROOT', dirname(__DIR__));
}
session_start();
session_destroy();

$config = parse_ini_file(ROOT.'/.env');

if ($config['ENV'] == 'prod') {
  header('Location: /index.php');
} else {
  header('Location: /contacts_manager/public/index.php');
}
exit;