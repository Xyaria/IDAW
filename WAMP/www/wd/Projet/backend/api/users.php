<?php
/*
POST /root/users
avec les infos qu'il faut : ajouter

PUT /root/users
modifier l'user avce les infos qu'il faut

DELETE /root/users
supprimer

POST /root/users/connect
connection
*/

/*GLOBAL TODO
* 
* OPTIONAL : 
* Secure sport level change (if sport level id selected exist)
* Generaly secure values (check variable length for example)
* try/catch on sql request
*
* INFORMATIONS :
* Add JSON_UNESCAPED_UNICODE as 2nd argument of json_encode to get full support of UTF-8
* + JSON_PRETTY_PRINT to have a nicely printed json for debugging
* -> json_encode($text, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
*/
    require_once("./generalAPI.php");

    function main(){        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_SERVER['PATH_INFO'])){
                requestConnect();
                return;
            }
            requestNewUser();
            return;
        }
        if($_SERVER['REQUEST_METHOD'] == 'PUT'){
            requestUpdate();
            return;
        }
        if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
            requestDeleteUser();
            return;
        }        
        else{
            jsonMessage(400, "Bad request");
            return;
        }
    }

    function requestNewUser(){
        $requiredValues= getUserTableColumns();

        $user = json_decode(file_get_contents("php://input"), true);

        if(isMissingRequiredValues($user, $requiredValues)){
            jsonMessage(400, "Missing values");
            return;
        }
        if(doesValueExist($user['login'], 'login', 'utilisateur')){
            jsonMessage(400, "User with this login already exist");
            return;
        }

        //can execute request
        executeSQLRequest("INSERT INTO utilisateur (login, mdp, nom, prenom, mail, id_niveau, sexe, date_naissance)".
                            " VALUES ('".$user['login']."', '".$user['mdp']."', '".$user['nom']."', '".$user['prenom']."', '".
                                        $user['mail']."', ".$user['id_niveau'].", '".$user['sexe']."', '".$user['date_naissance']."')");

        $id = executeSQLRequest("SELECT id_user from utilisateur where login = '" .$user['login']. "'");

        $id = $id[0]['id_user'];
        $json = ["location" => $id]; 
        jsonMessage(201, "User succesfully created", $json);
        
    }

    function requestConnect(){
        $URI = $_SERVER["PATH_INFO"];
        if ($URI != "/connect"){
            jsonMessage(400, "Bad path");
            return;
        }
        $requiredValues = array('login', 'mdp');
        $user = json_decode(file_get_contents("php://input"), true);
        if(isMissingRequiredValues($user, $requiredValues)){
            jsonMessage(400, "Missing values", ["User" => $user]);
            return;
        }

        //can execute request
        tryLogin($user['login'], $user['mdp']);
    }

    function requestUpdate(){
        $requiredValues= getUserTableColumns();
        $user = json_decode(file_get_contents("php://input"), true);
        
        if(!isIdValide($user, 'id_user', 'id_user', 'utilisateur')){
            return;
        }
        if(countNonMissingRequiredValues($user, $requiredValues) == 0){
            jsonMessage(400, "No values updated");
            return;
        }
        
        //can execute request
        $sqlRequest = "UPDATE utilisateur SET ";
        foreach($user as $field => $value){
            if($field != 'id_user'){
                $sqlRequest .= $field ." = '". $value . "', ";
            }
        }
        $sqlRequest = substr($sqlRequest, 0, strlen($sqlRequest)-2);
        $sqlRequest .= " WHERE id_user = " . $user['id_user'];

        executeSQLRequest($sqlRequest);
        jsonMessage(200, "User succesfully updated");
    }

    function requestDeleteUser(){
        $user = json_decode(file_get_contents("php://input"), true);
        if(!isIdValide($user, 'id_user', 'id_user', 'utilisateur')){ //error message already treated
            return;
        }

        //can execute request
        executeSQLRequest("DELETE FROM utilisateur WHERE id_user = '" .$user['id_user']. "'");
        jsonMessage(200, "User succesfully deleted");
        
    }

    function tryLogin($login, $mdp){
        global $pdo;
        $user = executeSQLRequest("SELECT id_user, login, nom, prenom, mail, id_niveau, sexe, date_naissance FROM `utilisateur` WHERE `login` = '". $login . "' AND `mdp` = '" . $mdp ."'");

        if($user == null){
            jsonMessage(400, "Login or password invalid");
            return;
        }

        $json = ["user" => $user[0]]; 
        jsonMessage(200, "Connected", $json);
        return;
    }

    function getUserTableColumns(){
        return array('login', 'mdp', 'nom', 'prenom', 'mail', 'id_niveau', 'sexe', 'date_naissance');
    }

    main();
?>