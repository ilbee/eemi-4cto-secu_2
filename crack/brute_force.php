<?php
// Flag indiquant que le mot de passe est trouvé
$find = false;
// Hash du mot de passe passé en argument du PHP CLI
$hash = $argv[1];
// Timestamp de départ
$start = time();
// Compteur de tentatives
$attempt = 0;
// On initialise le temps écoulé
$elapsed = 0;

function repeat($width, $position, $character)
{
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ !@#$%^&*()_+-=[]{}\|;:\'",./<>?`~';
    global $attempt, $hash, $find, $start, $elapsed;
    if ( $find ) {
        return;
    }

    for ($i = 0; $i < strlen($chars); $i++)
    {
        if ($position  < $width - 1) {
            repeat($width, $position + 1, $character . $chars[$i]);
        }

        $attempt++;
        $passwd = $character . $chars[$i];
        if ( md5($passwd) == $hash ) {
            $find = $passwd;
            $elapsed = time() - $start;
            return;
        }
    }
}

// Boucle jusqu'à une taille de mot de passe de 99 chars maximum
for ( $i=1; $i<=10; $i++ ) {
    echo 'Mot de passe de '.$i.' caractères ?'.PHP_EOL;
    repeat($i, 0, '');
}

// Affichage du résultat
echo PHP_EOL;

// Si on a trouvé le mot de passe
if ( $find ) {
    // On l'affiche
    echo 'Password found : "' . $find . '"';
// Sinon on affiche que le mot de passe n'a pas été trouvé
} else {
    echo 'Password not found in dictionary !' ;
}

// Affichage des stats de la recherche
echo PHP_EOL.'****************************************************'.PHP_EOL;
echo 'Time elapsed : '.$elapsed.' sec.';
echo PHP_EOL;
echo 'Attempt count : '.$attempt;
echo PHP_EOL;