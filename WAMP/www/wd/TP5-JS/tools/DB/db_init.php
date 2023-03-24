<?php
    require_once('../config.php');
    require_once('db_pdo.php');
    $pdo = getPDO();

    try {
        $sql = file_get_contents('tp4-rest.sql');
        $request = $pdo->exec($sql);
        echo "DB initialisée";
    } catch (PDOException $erreur) {
        echo ('Erreur : '.$erreur->getMessage());
    }

    echo "<br><a href='../users.php'>Back to page</a>";
?>