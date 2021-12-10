<?php
if ( isset($_SESSION['user']) ) {
    header('Location: index.php');
    exit;
}
require_once 'config.php';

$error = '';

if ( !empty($_POST['email']) && !empty($_POST['password']) ) {
    try {
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';port'.DB_PORT, DB_USER, DB_PASSWORD);
    } catch ( Exception $e ) {
        var_dump(DB_HOST, DB_NAME, DB_PORT, DB_USER, DB_PASSWORD);
        exit(sprintf('Unable to connect to MySQL database (%s)', $e->getMessage()));
    }

    $sql = 'SELECT * FROM users where email = "'.$_POST['email'].'" AND password = "'.md5($_POST['password']).'"';
   echo $sql;
    $req = $pdo->query($sql);
    if ( $req ) {
        $row = $req->fetch();
        $_SESSION['user'] = $row['id'];
        header('location: index.php');
        exit;
    }
    $error = 'Erreur d\'identification';
}
?>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php
    if ( !empty($error) ) {
        echo $error.'<br/>';
    }
    ?>
    <form name="login" method="post" action="login.php?action=login">
        email : <input type="text" name="email">
        <br/>
        password : <input type="password" name="password">
        <br/>
        <input type="submit" value="Connexion">
    </form>
    <hr/>
    <a href="register.php">Register</a>
</body>
</html>
