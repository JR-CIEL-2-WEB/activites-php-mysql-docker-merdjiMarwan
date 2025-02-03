<?php
header('Content-Type: application/json');
require 'db.php';

try {
    // Récupérer les employés et leurs salaires
    $stmt = $pdo->query("SELECT e.id, e.name, e.address, s.salary 
                         FROM employees_2 e 
                         INNER JOIN salaires s ON e.id = s.employees_2_id
                         ORDER BY s.salary");
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($employees)) {
        echo json_encode(['error' => 'Aucun employé trouvé']);
        exit;
    }

    // Calcul de la médiane des salaires
    $salaries = array_column($employees, 'salary');
    $count = count($salaries);

    $median = ($count % 2 === 0) ? 
        ($salaries[$count / 2 - 1] + $salaries[$count / 2]) / 2 :
        $salaries[floor($count / 2)];

    echo json_encode([
        'employees' => $employees,
        'median' => $median
    ]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur de récupération des données']);
}
?>
