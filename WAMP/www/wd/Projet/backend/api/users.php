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
* MANDATORY :
* Return for new user account : change to logged in ? -> give back id
*
* OPTIONAL : 
* Secure sport level change (if sport level id selected exist)
* Generaly secure values (check variable length for example)
* try/catch sur les requettes sql
*
* INFORMATIONS :
* Add JSON_UNESCAPED_UNICODE as 2nd argument of json_encode to get full support of UTF-8
* + JSON_PRETTY_PRINT to have a nicely printed json for debugging
* -> json_encode($text, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
*/
    require_once("generalAPI.php");

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
        $user = $user[0];

        if(isMissingRequiredValues($user, $requiredValues)){
            jsonMessage(400, "Missing values");
            return;
        }
        if(doesUserExist($user['login'])){
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
        $user = $user[0];
        if(isMissingRequiredValues($user, $requiredValues)){
            jsonMessage(400, "Missing values");
            return;
        }

        //can execute request
        tryLogin($user['login'], $user['mdp']);
    }

    function requestUpdate(){
        $requiredValues= getUserTableColumns();
        $user = json_decode(file_get_contents("php://input"), true);
        $user = $user[0];
        
        if(!isIdValide($user)){()
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
        $user = $user[0];
        if(!isIdValide($user)){ //error message already treated
            return;
        }

        //can execute request
        executeSQLRequest("DELETE FROM utilisateur WHERE id_user = '" .$user['id_user']. "'");
        jsonMessage(200, "User succesfully deleted");
        
    }

    function tryLogin($login, $mdp){
        global $pdo;
        $user = executeSQLRequest("SELECT * FROM `utilisateur` WHERE `login` = '". $login . "' AND `mdp` = '" . $mdp ."'");

        if($user == null){
            jsonMessage(400, "Login or password invalid");
            return;
        }

        $json = ["user" => $user[0]]; 
        jsonMessage(200, "Connected", $json);
        return;
    }

    function isMissingRequiredValues($arrayToCheck, $requiredValues){
        if(countNonMissingRequiredValues($arrayToCheck, $requiredValues) != sizeof($requiredValues)){
            return true;
        }
        return false;
    }

    function countNonMissingRequiredValues($arrayToCheck, $requiredValues){
        $nonMissingValues = 0;
        foreach($requiredValues as $value){
            if(isset($arrayToCheck[$value])){
                $nonMissingValues += 1;
            }
        }
        return $nonMissingValues;
    }

    function isIdValide($user){

        if(!isset($user['id_user'])){
            jsonMessage(400, "Missing Id");
            return false;
        }
        $id = $user['id_user'];
        if(!is_numeric($id)){   //is_numérique renvoie false si chaine nulle
            jsonMessage(400, "Id is invalid");
            return false;
        }
        if(!doesIdExist($id)){
            jsonMessage(400, "User does not exist");
            return false;
        }
        return true;
    }

    function doesUserExist($login){
        return doesUserIdExist($login, "login");
    }

    function doesIdExist($id){
        return doesUserIdExist($id, "id_user");
    }

    function doesUserIdExist($value, $field){
        $correspondingUser = executeSQLRequest("SELECT id_user FROM utilisateur WHERE " .$field. " = '" . $value. "'");
        if($correspondingUser == null){
            return false;
        }
        return true;
    }

    function getUserTableColumns(){
        return array('login', 'mdp', 'nom', 'prenom', 'mail', 'id_niveau', 'sexe', 'date_naissance');
    }

    main();
?>