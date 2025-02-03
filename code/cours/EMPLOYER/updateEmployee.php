<?php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);
$id = $_GET['id']; // Vérifie que l'ID est bien passé dans l'URL

if (!isset($data['name'], $data['address'], $data['salary'])) {
    echo json_encode(['success' => false, 'message' => 'Données invalides']);
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE employees_2 SET name = ?, address = ? WHERE id = ?");
    $stmt->execute([$data['name'], $data['address'], $id]);

    $stmt = $pdo->prepare("UPDATE salaires SET salary = ? WHERE employees_2_id = ?");
    $stmt->execute([$data['salary'], $id]);

    echo json_encode(['success' => true, 'message' => 'Employé mis à jour avec succès']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour', 'error' => $e->getMessage()]);
}
?>
