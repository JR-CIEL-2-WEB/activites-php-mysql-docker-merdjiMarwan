<?php
// Inclure les fichiers nécessaires
include 'tri_selection_reference.php'; // Fichier contenant la fonction de tri
include 'statistique.php'; // Fichier contenant la fonction de calcul de la médiane

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données JSON
    $data = json_decode(file_get_contents("php://input"), true);
    $tableau = $data['t'] ?? [];

    // Vérification si le tableau est vide
    if (empty($tableau)) {
        echo json_encode(["error" => "Tableau vide"]);
        exit;
    }

    // Appel à la fonction de tri
    tri_selection_reference($tableau); // Tri en place

    // Appel à la fonction de calcul de la médiane
    $mediane = mediane($tableau); // Utiliser la fonction mediane

    // Réponse JSON avec le tableau trié et la médiane
    echo json_encode(["sorted" => $tableau, "mediane" => $mediane]);
    exit;
}
?>
