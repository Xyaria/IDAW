<?php

    /*notes par Corentin
    * Dans les get d'aliments plus détaillés (get 1 ou get X, pas getALL), 
    * faudra ajouter les nutriments associés (sinon faut des 
    * endpoint de l'api spéciale pour mais ça n'a pas de sens)
    * à voir si on ajoute des colones par défaut (energie, protéine, ...) 
    * ou si on récupère ça en paramètre json (voire les deux optionss)
    */

    require_once("db_pdo.php");
    require_once("config.php");

    header("Content-type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Max-Age: 3600");

    $pdo = getPDO();

    function jsonMessage($status, $message, $other = NULL){
        http_response_code($status);
        $jsonMessage = ["status" => $status, "message" => $message];

        if(isset($other)){
            foreach($other as $key => $value){
                $jsonMessage[$key] = $value;
            }
        }

        echo json_encode($jsonMessage);
    }

    function chooseAlimentsFunc(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            getAliment($id);
            return;
        }
        if(isset($_GET['from']) AND isset($_GET['nb'])){
            $id = $_GET['from'];
            $qtt = $_GET['nb'];
            getXAliments($id, $qtt);
            return;
        }
        if(substr($_SERVER['REQUEST_URI'], -8) !== "aliments"){
            jsonMessage(400, "This query is not supported");
            return;
        }
        getAllAliments();
    }

    function getAliment($id){
        global $pdo;
        if(!is_numeric($id)){
            jsonMessage(400, "ID should be numeric");
            return;
        }
        $request = $pdo->prepare("SELECT * FROM aliment WHERE `id` = $id");
        $request->execute();
        $aliment = $request->fetch(PDO::FETCH_ASSOC);
        echo json_encode($aliment);
    }

    function getXAliments($id, $qtt){
        global $pdo;
        if(!is_numeric($id)){
            jsonMessage(400, "ID should be numeric");
            return;
        }
        $request = $pdo->prepare("SELECT * FROM aliment WHERE `id_aliment` IN($id, $id+$qtt-1)");
        $request->execute();
        $aliment = $request->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($aliment);
    }

    function getAllAliments(){
        global $pdo;
        $request = $pdo->prepare("SELECT * FROM aliment");
        $request->execute();
        $aliment = $request->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($aliment);
    }

    $reqMethod = $_SERVER['REQUEST_METHOD'];
    
    switch($reqMethod){
        case 'GET':
            chooseAlimentsFunc();
            break;
        default:
            jsonMessage(405, "Unauthorized Method");
    };

?>