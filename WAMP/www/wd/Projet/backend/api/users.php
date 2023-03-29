<?php
/*
POST /root/users
avec les infos qu'il faut : ajouter

PUT /root/users?id={id}
modifier l'user avce les infos qu'il faut

DELETE /root/users?id={id}
supprimer

POST /root/users/connect
connection
*/

/*GLOBAL TODO
* MANDATORY :
* Check for duplicate printing of errors
* Return for new user account : change to logged in ? -> give back id
*
* OPTIONAL : 
* Secure sport level change (if sport level id selected exist)
*/
    require_once("../sql/db_pdo.php");
    $pdo = getPDO();

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

    //TO TEST //TODO create user and send back ok
    function requestNewUser(){
        $requiredValues= getUserTableColumns('login', 'mdp', 'nom', 'prenom', 'mel', 'niveau', 'sexe', 'naissance');

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
    }

    //TO TEST //TODO update user and send back ok
    function requestUpdate(){
        $requiredValues= getUserTableColumns('login', 'mdp', 'nom', 'prenom', 'mel', 'niveau', 'sexe', 'naissance');
        $user = json_decode(file_get_contents("php://input"), true);

        if(!isIdValide()){
            return;
        }
        if(countNonMissingRequiredValues() == 0){
            //error no change
            return;
        }

        //update request
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
            return false
        }
        $id = $_POST['id'];
        if(!is_numeric($id)){   //is_numérique renvoie false si chaine nulle
            //erreur id
            return false
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

    //TO TEST
    function executeSQLRequest($SQLrequest){
        $request = $pdo->prepare($SQLrequest);
        $request->execute();
        return($request->fetch_all(PDO::FETCH_ASSOC));
    }

    function getUserTableColumns(){
        return array('login', 'mdp', 'nom', 'prenom', 'mel', 'niveau', 'sexe', 'naissance');
    }

    main();
?>