<?php

$max = 5;

echo "Table de multiplication jusqu'à $max x $max\br";


echo str_pad(" ", 5); 
for ($i = 1; $i <= $max; $i++) {
    echo str_pad($i, 5, " ", STR_PAD_BOTH); 
echo "\br";


echo str_repeat("-", $max * 5 + 5) . "\br";


for ($i = 1; $i <= $max; $i++) {
    echo str_pad($i, 5, " ", STR_PAD_BOTH); 
    for ($j = 1; $j <= $max; $j++) {
        echo str_pad($i * $j, 5, " ", STR_PAD_BOTH); 
    }
    echo "\br";
}
}
?>