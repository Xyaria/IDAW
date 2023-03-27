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
    require_once("../sql/db_pdo.php");
    $pdo = getPDO();

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

    function requestConnect(){
        $URI = $_SERVER["PATH_INFO"];
        if ($URI != "/connect"){
            //erreur pas bon chemin
            return;
        }

        $requiredValues = array('login', 'mdp');

        $user = json_decode(file_get_contents("php://input"), true);
        if(isMissingRequiredValues($user, $requiredValues)){
            return;
        }

        //si arrivé ici, c'est que ok
        tryLogin($user['login'], $user['mdp']);
    }

    function requestNewUser(){
        $requiredValues= array('login', 'mdp', 'niveau', 'sexe', 'naissance');

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

    function requestUpdate(){
        if(!isset($_POST['id'])){
            //erreur manque id
            return;
        }


    }

    function requestDeleteUser(){
        if(!isset($_POST['id'])){
            //erreur manque id
            return;
        }
    
    }

    function tryLogin($login, $mdp){
        global $pdo;
        $users = $pdo->prepare("SELECT * FROM `utilisateur` WHERE `login` = ". $login . " AND `mdp` =" . $mdp );
        $users->execute();
        $user = $users->fetchall(PDO::FETCH_ASSOC);
        print_r($user);
        return;
    }

    function isMissingRequiredValues($arrayToCheck, $requiredValues){
        foreach($requiredValues as $value){
            if(!isset($arrayToCheck[$value])){
                //erreur
                return true;
            }
        }
        return false;
    }

    main();
?>