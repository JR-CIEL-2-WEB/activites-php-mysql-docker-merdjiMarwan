<?php
// Charger les données depuis le fichier courses.json
$coursesData = json_decode(file_get_contents('courses.json'), true);

// Récupérer l'ID de la course depuis les paramètres de la requête
$idCourse = $_GET['idCourse'] ?? null;

if ($idCourse) {
    foreach ($coursesData as $course) {
        if ($course['id'] === $idCourse) {
            // Renvoyer uniquement les markers de la course demandée
            header('Content-Type: application/json');
            echo json_encode(["markers" => $course['markers']]); // Envoyer seulement les markers
            exit;
        }
    }
}

// Si aucune course correspondante n'est trouvée
header("HTTP/1.0 404 Not Found");
echo json_encode(["error" => "Course not found"]);
?>
