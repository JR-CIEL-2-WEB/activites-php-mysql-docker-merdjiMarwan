<?php
function tri_selection_reference(&$salaires) {
    $taille = count($salaires);
    for ($i = 0; $i < $taille - 1; $i++) {
        $indice_min = $i;
        for ($j = $i + 1; $j < $taille; $j++) {
            if ($salaires[$j] < $salaires[$indice_min]) {
                $indice_min = $j;
            }
        }
        if ($indice_min != $i) {
            $temporaire = $salaires[$i];
            $salaires[$i] = $salaires[$indice_min];
            $salaires[$indice_min] = $temporaire;
        }
    }
}
?>
