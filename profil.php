<?php
require_once 'config.php';

try {
    $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';port'.DB_PORT, DB_USER, DB_PASSWORD);
} catch ( Exception $e ) {
    var_dump(DB_HOST, DB_NAME, DB_PORT, DB_USER, DB_PASSWORD);
    exit(sprintf('Unable to connect to MySQL database (%s)', $e->getMessage()));
}

$sql = 'SELECT id, email, created_at, last_login_at FROM users WHERE email = :email';
echo $sql;
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $_GET['email'], PDO::PARAM_STR);
$stmt->execute();
//$stmt = $pdo->query($sql);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<html>
<head>
    <title>Profil de <?php $_GET['email']; ?></title>
</head>
<body>
<h1>Profil de <?php echo $_GET['email']; ?></h1>

Voici les infos de l'utilisateur <?php echo $_GET['email']; ?> :
<table>
    <?php
    foreach ( $row as $key => $value ) {
        echo '<tr><td>'.$key.'</td><td>===>>'.$value.'</td></tr>';
    }
    ?>
</table>
</body>
</html>