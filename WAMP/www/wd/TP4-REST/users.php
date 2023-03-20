
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
    require_once('./DB_Management/db_pdo.php');
    $pdo = getPDO();

    $request = $pdo->prepare("SELECT * FROM users");
    $request->execute();
    $dbRows = $request->fetchAll();

    $request = $pdo->prepare("DESCRIBE users");
    $request->execute();
    $dbColumns = $request->fetchAll(PDO::FETCH_COLUMN);

    echo "<h1>Users</h1>";
    echo "<form action='users.php' method='POST'>
    <table>
    <thead>
        <tr>";
    echo "<th>Sélection</th>";

    foreach($dbColumns as $key => $value){
        echo "<th>" .ucfirst($value). "</th>";
    }

    echo "</tr>
    </thead>
    <tbody>";

    foreach($dbRows as $key => $value){
        echo "<tr>";
        echo "<td><input type='radio' name='select' value='" .$value['id']. "'></td>";
        for ($i=0; $i < count($dbColumns); $i++) { 
            echo "<td>" .$value[$i]. "</td>";
        }
        echo "</tr>";
    }

    echo "</tbody>
    </table>";

    echo "<input type='submit' name='Add' value='Ajouter/Modifier'><br>
        <input type='submit' name='Delete' value='Supprimer sélectionné'>";
    echo "</form>";

    if(isset($_POST['Add'])){

    }
    else if(isset($_POST['Delete'])){
        
    }

    /*** close connection ***/
    $pdo = null;
?>
    