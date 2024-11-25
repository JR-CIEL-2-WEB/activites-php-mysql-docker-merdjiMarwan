<?php
require_once 'statistique.php';
include('tri_selection_reference.php');
include('read_tab.php');

$salaires = [1500, 4500, 2200, 1500, 1700, 1800, 2000, 3300, 4000];

$moyenne_salaire = moyenne($salaires);

$mediane_salaire = mediane($salaires);

$salaire_nicolas = 2200;

echo "Moyenne des salaires : " . number_format($moyenne_salaire, 2) . " €<br>";
echo "Médiane des salaires : " . number_format($mediane_salaire, 2) . " €<br>";

if ($salaire_nicolas < $mediane_salaire) {
    echo "Nicolas est parmi les moins bien payés de l'entreprise.<br>";
} else {
    echo "Nicolas n'est pas parmi les moins bien payés de l'entreprise.<br>";
}
?>
