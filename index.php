<?php
require_once 'config.php';

try {
    $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';port'.DB_PORT, DB_USER, DB_PASSWORD);
} catch ( Exception $e ) {
    var_dump(DB_HOST, DB_NAME, DB_PORT, DB_USER, DB_PASSWORD);
    exit(sprintf('Unable to connect to MySQL database (%s)', $e->getMessage()));
}
?>
<html>
<head>
    <title>Hello !</title>
</head>
<body>
<h1>Hello !</h1>

Voici la liste des utilisateurs :
<table>
    <tr>
        <td>Id</td>
        <td>Email</td>
        <td>Action</td>
    </tr>
    <?php
    $sql = "SELECT * FROM users";
    $req = $pdo->query($sql);

    while ( $row = $req->fetch() ) {
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><a href="profil.php?email=<?php echo $row['email']; ?>">Profil</a></td>
        </tr>
        <?php
    }
    ?>
</table>
</body>
</html>
