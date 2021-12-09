<?php
if ( isset($_SESSION['user']) ) {
    header('Location: index.php');
    exit;
}
require_once 'config.php';

if ( !empty($_POST['email']) && !empty($_POST['password']) ) {
    try {
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';port'.DB_PORT, DB_USER, DB_PASSWORD);
    } catch ( Exception $e ) {
        var_dump(DB_HOST, DB_NAME, DB_PORT, DB_USER, DB_PASSWORD);
        exit(sprintf('Unable to connect to MySQL database (%s)', $e->getMessage()));
    }

    $sql = '
    INSERT INTO
        users (email, password, created_at, last_login_at) VALUES ("'.$_POST['email'].'", "'.md5($_POST['password']).'", NOW(), NOW())';
    echo $sql;
    $req = $pdo->exec($sql);
    if ( $req ) {
        $_SESSION['user'] = $pdo->lastInsertId();
        header('location: index.php');
        exit;
    }
    $error = 'Erreur d\'inscription';
}
?>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <?php
    if ( !empty($error) ) {
        echo $error.'<br/>';
    }
    ?>
    <form method="post">
        email : <input type="text" name="email">
        <br/>
        password : <input type="password" name="password">
        <br/>
        <input type="submit" value="Register">
    </form>
</body>
</html>
