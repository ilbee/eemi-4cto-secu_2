<?php
// Chemin vers le fichier rockyou (ici rockyout "light")
$file = 'rockyoulight.txt';
// Taille du fichier rock you (pour calculer la taille du dictionnaire)
$size = filesize($file);
// Taille des lignes déjà lues
$rowed = 0;
// Hash du mot de passe passé en argument du PHP CLI
$hash = $argv[1];
// Ouverture du fichier rock you en lecture seule
$handle = fopen($file, 'rb');
// Timestamp de départ
$start = time();
// Flag indiquant que le mot de passe est trouvé
$find = false;
// Dernier taux de progression affiché (0 par défaut)
$lastRate = 0;
// Compteur de tentatives
$attempt = 0;
// On initialise le temps écoulé
$elapsed = 0;

// Boucle sur chaque ligne du fichier rockyou
while (($line = fgets($handle, 4096)) !== false) {
    // On incrémente le compteur de la taille des lignes lues
    $rowed += strlen($line);
    // On remplace les caractères de saut de ligne par rien
    $line = str_replace([chr(10), chr(13)], '', $line);
    // On calcule le taux de progression
    $rate = round(($rowed * 100 ) / $size, 2);

    // Si le hash MD5 de la ligne est égal au hash du mot de passe passé en argument
    if ( md5($line) == $hash ) {
        // On a trouvé le mot de passe
        $find = $line;
        // On calcul le temps passé
        $elapsed = time() - $start;
        // On sort de la boucle
        break;
    // Si le hash n'est pas bon et qu'on a un taux d'avancement sans décimal et qu'il est différent du précédent
    } else if ( ceil($rate) === $rate && $rate !== $lastRate ) {
        // On affiche le taux d'avancement
        echo $rate.'%'.PHP_EOL;
        // On stocke le taux d'avancement affiché
        $lastRate = $rate;
    }

    // On incrémente le compteur de tentatives
    $attempt++;
// Fin de la boucle de lecture
}

// On ferme le fichier rock you
fclose($handle);

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