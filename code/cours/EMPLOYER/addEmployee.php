<?php
header('Content-Type: application/json');
require 'db.php'; // Importer la connexion PDO

// Récupérer les données JSON envoyées
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['name'], $data['address'], $data['salary'])) {
    echo json_encode(['success' => false, 'message' => 'Données invalides']);
    exit;
}

try {
    // Insérer l'employé
    $stmt = $pdo->prepare("INSERT INTO employees_2 (name, address) VALUES (?, ?)");
    $stmt->execute([$data['name'], $data['address']]);
    $employeeId = $pdo->lastInsertId();

    // Insérer le salaire
    $stmt = $pdo->prepare("INSERT INTO salaires (employees_2_id, salary) VALUES (?, ?)");
    $stmt->execute([$employeeId, $data['salary']]);

    echo json_encode(['success' => true, 'message' => 'Employé ajouté avec succès']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout', 'error' => $e->getMessage()]);
}
?>
