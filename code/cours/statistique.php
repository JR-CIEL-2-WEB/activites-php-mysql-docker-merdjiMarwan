<?php
function moyenne($salaires) {
    return array_sum($salaires) / count($salaires);
}

function mediane($salaires) {
    $n = count($salaires);
    
    if ($n % 2 == 0) {
        $milieu1 = $salaires[$n / 2 - 1];
        $milieu2 = $salaires[$n / 2];
        return ($milieu1 + $milieu2) / 2;
    } else {
        return $salaires[floor($n / 2)];
    }
}
?>
