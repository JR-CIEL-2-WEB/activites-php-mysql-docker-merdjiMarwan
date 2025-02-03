<?php
$host = "mysql"; // ⚠️ DOCKER UTILISE LE NOM DU SERVICE COMME HOST !
$dbname = "appdb";
$username = "eleve";
$password = "eleve";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>