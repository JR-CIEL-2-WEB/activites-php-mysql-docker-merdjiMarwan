<?php
header('Content-Type: application/json');
require 'db.php';

$id = $_GET['id'];

try {
    // Supprimer le salaire
    $stmt = $pdo->prepare("DELETE FROM salaires WHERE employees_2_id = ?");
    $stmt->execute([$id]);

    // Supprimer l'employé
    $stmt = $pdo->prepare("DELETE FROM employees_2 WHERE id = ?");
    $stmt->execute([$id]);

    echo json_encode(['success' => true, 'message' => 'Employé supprimé avec succès']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression', 'error' => $e->getMessage()]);
}
?>
