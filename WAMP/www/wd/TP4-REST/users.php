<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-type">
    <title>Mon site tout beau</title>
    <link href="css.css" type="text/css" rel="stylesheet">
    <!--<script src="path/to/js"></script>-->
</head>
<body>
    <h1>Users</h1>
<?php
    require_once('config.php');
    require_once('./DB/db_pdo.php');
    $pdo = getPDO();

    echo $actionResult = (function () {
        $pdo = getPDO();
        if(isset($_POST['add'])){
            if(!isset($_POST['userName']) OR !isset($_POST['userMail'])) {
                return "Informations manquantes, impossible d'ajouter l'utilisateur";
            }
            else{
                $request = $pdo->prepare("INSERT INTO `users` (`name`, `mail`) VALUES ('" .$_POST['userName']. "', '" .$_POST['userMail']. "')");
                $request->execute();
                return "Utilisateur " .$_POST['userName']. " ajouté";
            }
        }
        if(isset($_POST['select'])){
            if(isset($_POST['modify'])){
                if(!isset($_POST['userName']) AND !isset($_POST['userMail'])){
                    return "Entrer au moins une information à modifier";
                }
                else {
                    $reqBody = NULL;
                    if(isset($_POST['userName']) AND $_POST['userName'] != NULL){
                        $reqBody = "`name`='" .$_POST['userName']. "'";
                    }
                    if(isset($_POST['userMail']) AND $_POST['userMail'] != NULL){
                        if($reqBody !== NULL){
                            $reqBody .= ", `mail`='" .$_POST['userMail']. "'";
                        }
                        else{
                            $reqBody = "`mail`='" .$_POST['userMail']. "'";
                        }
                    }
                    $request = $pdo->prepare("UPDATE `users` SET ".$reqBody." WHERE `id`=" .$_POST['select']);
                    $request->execute();
                    return "Utilisateur " .$_POST['select']. " modifié";
                }
            }
            else if(isset($_POST['delete'])){
                $request = $pdo->prepare("DELETE FROM `users` WHERE `id`=" .$_POST['select']);
                $request->execute();
                return "Utilisateur " .$_POST['select']. " supprimé";
            }
        }
    })();

    $request = $pdo->prepare("SELECT * FROM users");
    $request->execute();
    $dbRows = $request->fetchAll();

    $request = $pdo->prepare("DESCRIBE users");
    $request->execute();
    $dbColumns = $request->fetchAll(PDO::FETCH_COLUMN);

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
        echo "<td><input class='radio' type='radio' name='select' value='" .$value['id']. "'></td>";
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
        <div class="container">
            <input type='text' name='userName' placeholder='Nom'><br>
            <input type='text' name='userMail' placeholder='Mail'>

            <input type='submit' name='add' value='Ajouter'><br>
            <input type='submit' name='modify' value='Modifier'>
            <input type='submit' name='delete' value='Supprimer'>
        </div>
    </form>

    <br>
    <a href='./DB/db_init.php'>Reset DB</a>


</body>
</html>