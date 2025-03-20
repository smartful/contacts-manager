<?php
session_start();

session_destroy();
header('Location: /contacts_manager/public/index.php');