<?php
/*
POST /root/users
avec les infos qu'il faut : ajouter

PUT /root/users/{id}
modifier l'user avce les infos qu'il faut

DELETE /root/users/{id}
supprimer

POST /root/users/connect
connection
*/

/*GLOBAL TODO
* MANDATORY :
* Check for duplicate printing of errors
* Return for new user account : change to logged in ? -> give back id
* Replace put and delete methods because can't use in-url variables
*
* OPTIONAL : 
* Secure sport level change (if sport level id selected exist)
* Generaly secure values (check variable length for example)
*
* INFORMATIONS :
* Add JSON_UNESCAPED_UNICODE as 2nd argument of json_encode to get full support of UTF-8
* + JSON_PRETTY_PRINT to have a nicely printed json for debugging
* -> json_encode($text, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
*/
    require_once("generalAPI.php");

    //TO TEST //TODO error throw
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
            //Existe pas
            return;
        }
    }

    //OK
    function requestConnect(){
        $URI = $_SERVER["PATH_INFO"];
        if ($URI != "/connect"){
            //erreur bad path
            return;
        }

        $requiredValues = array('login', 'mdp');
        $user = json_decode(file_get_contents("php://input"), true);
        if(isMissingRequiredValues($user, $requiredValues)){
            return;
        }

        tryLogin($user['login'], $user['mdp']);
    }

    //TO TEST
    function requestNewUser(){
        $requiredValues= getUserTableColumns();

        $user = json_decode(file_get_contents("php://input"), true);
        if(isMissingRequiredValues($user, $requiredValues)){
            return;
        }

        if(userExist($user['login'])){
            //erreur
            return;
        }

        //si arrivé ici, c'est que ok
        //gérer la création de compte
        //$dbUser = executeSQLRequest("INSERT INTO utilisateur (login, mdp, nom, prenom, mail, niveau, sexe, naissance)
        //                                VALUES ($user['login'], $user['mdp'], $user['nom'], $user['prenom'], 
        //                                        $user['mail'], $user['niveau'], $user['sexe'], $user['naissance'])");

        if($dbUser == null){
            //Error quelque part
            return;
        }

        $json = ["location" => $dbUser['id']]; 
        jsonMessage(201, "User succesfully created", $json);
        
    }

    //TO TEST //TODO update user and send back ok
    function requestUpdate(){
        $requiredValues= getUserTableColumns();
        $user = json_decode(file_get_contents("php://input"), true);


        /*
        if(!isIdValide()){
            return;
        }
        if(countNonMissingRequiredValues() == 0){
            //error no change
            return;
        }
*/
        $sqlRequest = "UPDATE TABLE utilisateur SET ";
        foreach($user[0] as $field => $value){
            $sqlRequest .= $field ." = ". $value;
        }

        print_r($_PUT);
        $sqlRequest .= "WHERE id = ".$_PUT['id'];

        print($sqlRequest);
        $update = executeSQLRequest($sqlRequest);
        print_r($update);
    }

    //TO TEST //TODO remove user and send back ok
    function requestDeleteUser(){
        if(!isIdValide()){
            return;
        }
        
        //request remove user
    }

    //TODO check if returned user is ok and send back ok
    function tryLogin($login, $mdp){
        global $pdo;
        $user = executeSQLRequest("SELECT * FROM `utilisateur` WHERE `login` = ". $login . " AND `mdp` =" . $mdp );
        print_r($user);
        return;
    }

    //TODO error throw
    function isMissingRequiredValues($arrayToCheck, $requiredValues){
        if(countNonMissingRequiredValues($arrayToCheck, $requiredValues) != sizeof($requiredValues)){
            return false;
        }
        return true;
    }

    //TO TEST
    function countNonMissingRequiredValues($arrayToCheck, $requiredValues){
        $nonMissingValues = 0;
        foreach($requiredValues as $value){
            if(!isset($arrayToCheck[$value])){
                $nonMissingValues += 1;
            }
        }
        return $nonMissingValues;
    }

    //TO TEST  //TODO error throw
    function isIdValide(){
        if(!isset($_POST['id'])){
            //erreur id
            return false;
        }
        $id = $_POST['id'];
        if(!is_numeric($id)){   //is_numérique renvoie false si chaine nulle
            //erreur id
            return false;
        }
        if(!doesIdExist($id)){
            //erreur id
            return false;
        }
        return true;
    }

    //TO TEST
    function doesIdExist($id){
        $correspondingUser = executeSQLRequest("SELECT id FROM utilisateur WHERE id = " . $id);
        if($correspondingUser == null){
            return false;
        }
        return true;
    }

    function getUserTableColumns(){
        return array('login', 'mdp', 'nom', 'prenom', 'mail', 'niveau', 'sexe', 'naissance');
    }

    main();
?>