<?php
include 'triangle.php'; 

// Vérifier si le paramètre n existe dans l'url
if (isset($_GET['n'])) {
    $n = $_GET['n']; // recupere la valeur de n depuis l'url
    triangle($n); // appelle la fonction triangle avec n
} else {
    echo "Veuillez spécifier le nombre de lignes dans l'URL avec ?n=nombre";
}
?>
