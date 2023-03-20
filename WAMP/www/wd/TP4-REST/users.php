
<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-type">
    <title>Mon site tout beau</title>
    <link href="css.css" type="text/css" rel="stylesheet">
    <!--<script src="path/to/js"></script>-->
</head>
<?php
    require_once('config.php');

    $connectionString = "mysql:host=". _MYSQL_HOST;

    if(defined('_MYSQL_PORT')) {
        $connectionString .= ";port=". _MYSQL_PORT;
    }

    $connectionString .= ";dbname=" . _MYSQL_DBNAME;
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' );
    
    $pdo = NULL;
    try {
        $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $erreur) {
        echo ('Erreur : '.$erreur->getMessage());
    }

    $request = $pdo->prepare("SELECT * FROM users");
    $request->execute();
    $dbRows = $request->fetchAll();

    $request = $pdo->prepare("DESCRIBE users");
    $request->execute();
    $dbColumns = $request->fetchAll(PDO::FETCH_COLUMN);

    echo "<h1>Users</h1>";
    echo "<table>
    <thead>
        <tr>";
        
    foreach($dbColumns as $key => $value){
        echo "<td>" .$value. "</td>";
    }

    echo "</tr>
    </thead>
    <tbody>";

    foreach($dbRows as $key => $value){
        echo "<tr>";
        for ($i=0; $i < count($dbColumns); $i++) { 
            echo "<td>" .$value[$i]. "</td>";
        }
        echo "</tr>";
    }

    echo "</tbody>
    </table>";

    /*** close connection ***/
    $pdo = null;
?>
    