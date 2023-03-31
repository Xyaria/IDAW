<?php
    require_once("../sql/db_pdo.php");
    require_once("../config.php");
    require_once("generalAPI.php");

    header("Content-type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Max-Age: 3600");

    $pdo = getPDO();

    function chooseAliments(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $result = getAliment($id);
        }
        else if(isset($_GET['from']) AND isset($_GET['nb'])){
            $id = $_GET['from'];
            $qtt = $_GET['nb'];
            $result = getXAliments($id, $qtt);
        }
        else if(substr($_SERVER['REQUEST_URI'], -9) !== "aliments/" AND substr($_SERVER['REQUEST_URI'], -8) !== "aliments"){
            jsonMessage(400, "This query is not supported");
            return;
        }
        else {
            $result = getAllAliments();
        }
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    function getAliment($id){
        if(!is_numeric($id)){
            jsonMessage(400, "ID should be numeric");
            return;
        }

        $db_aliment = executeSQLRequest(
            "SELECT aliment.LABEL 'Nom', type.LABEL 'Type' 
            FROM `aliment` 
                JOIN `type` 
            WHERE aliment.ID_ALIMENT = $id"
        );

        $db_alimentDetails = executeSQLRequest(
            "SELECT nutriment.LABEL 'Nutriment', contient.QUANTITE 'Quantité' 
            FROM `contient` 
                JOIN `aliment` ON contient.ID_ALIMENT = aliment.ID_ALIMENT 
                JOIN `nutriment` ON contient.ID_NUTRIMENT = nutriment.ID_NUTRIMENT 
            WHERE aliment.ID_ALIMENT = $id"
        );

        $alimentDetails = [];
        for ($i=0; $i < count($db_alimentDetails); $i++) { 
            array_push($alimentDetails, [$db_alimentDetails[$i]["Nutriment"] => $db_alimentDetails[$i]["Quantité"]]);
        }

        $aliment = [
            "Nom" => $db_aliment[0]["Nom"], 
            "Type" =>$db_aliment[0]["Type"], 
            "Nutriments" => array_merge(...$alimentDetails)
        ];
        return $aliment;
    }

    function getXAliments($id, $qtt){
        if(!is_numeric($id)){
            jsonMessage(400, "ID should be numeric");
            return;
        }
        if(!is_numeric($qtt)){
            jsonMessage(400, "Quantity should be numeric");
            return;
        }
        
        $aliment = [];
        for($i = $id; $i < $id+$qtt; $i++){
            array_push($aliment, getAliment($i));
        }

        return $aliment;
    }

    function getAllAliments(){
        $aliment = executeSQLRequest("SELECT aliment.LABEL 'Aliment' FROM `aliment`");
        return $aliment;
    }

    $reqMethod = $_SERVER['REQUEST_METHOD'];
    
    switch($reqMethod){
        case 'GET':
            chooseAliments();
            break;
        default:
            jsonMessage(405, "Unauthorized Method");
    };

?>