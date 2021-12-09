<?php
$find = false;
$chaine = 'abcdefghijklmnopqrstuvwxyzA';

$hash = '5d9cc902d4187c5bee3bd85822eedc9e';
$count = 0;
$start = time();
$check = [];

while ( !$find ) {
    $str = '';
    for ( $i = 0; $i < 5; $i++ ) {
        $str .= $chaine[rand(0, strlen($chaine) - 1)];
    }
    if ( in_array($str, $check) ) {
        continue;
    }
    if ( md5($str) == $hash ) {
        $find = true;
        $elapsed = time() - $start;
    } else {
        echo '.';
        $count++;
    }
}

echo PHP_EOL.'Mot de passe trouvé en '.$elapsed.' seconde(s) et '.$count.' tentative = '.$str.PHP_EOL;
