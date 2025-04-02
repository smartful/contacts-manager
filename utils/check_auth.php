<?php
if (!defined('ROOT')) {
    define('ROOT', dirname(__DIR__, 2));
}
$config = parse_ini_file(ROOT.'/.env');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    if ($config['ENV'] == 'prod') {
        header('Location: /index.php');
    } else {
        header('Location: /contacts_manager/public/index.php');
    }
    exit;
}