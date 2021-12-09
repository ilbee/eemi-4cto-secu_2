<?php
session_start();

if ( empty($_SESSION['user']) ) {
    $_SESSION['user'] = time();
}

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'secu');
define('DB_PORT', 3306);

