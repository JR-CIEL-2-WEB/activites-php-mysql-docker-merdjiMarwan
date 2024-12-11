<?php
function tri_selection_valeur($tableau) {
    $taille = count($tableau);
    for ($i = 0; $i < $taille - 1; $i++) {
        $indice_min = $i;
        for ($j = $i + 1; $j < $taille; $j++) {
            if ($tableau[$j] < $tableau[$indice_min]) {
                $indice_min = $j;
            }
        }
        if ($indice_min != $i) {
            $temporaire = $tableau[$i];
            $tableau[$i] = $tableau[$indice_min];
            $tableau[$indice_min] = $temporaire;
        }
    }
    return $tableau;
}
?>
