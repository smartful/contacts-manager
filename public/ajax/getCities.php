<?php
define('ROOT', dirname(__DIR__, 2));
require_once(ROOT."/utils/connexion_db.php");

if (!isset($_GET['search']) || empty($_GET['search'])) {
    echo json_encode([]);
    exit;
}

$search = htmlspecialchars($_GET['search']) . '%';

$query = $bdd->prepare("
    SELECT id, postal_code, city_name FROM cities
    WHERE city_name LIKE :search
    OR postal_code LIKE :search
    ORDER BY city_name
    LIMIT 10
");
$query->execute(['search' => $search]);

$cities = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($cities);