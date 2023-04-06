<?php
    require_once("./generalAPI.php");

    function chooseGetAliment(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $result = getAliment($id);
        }
        else {
            $result = getAllAliments();
        }
        echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
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

    function getAllAliments(){
        $aliments = [];
        $id = 1;
        $max_id = executeSQLRequest("SELECT MAX(ID_ALIMENT) 'ID' FROM `aliment`");
        while($id <= $max_id[0]['ID']){
            array_push($aliments, getAliment($id));
            $id ++;
        }
        // $aliments_list = executeSQLRequest("SELECT aliment.LABEL 'Aliment' FROM `aliment`");
        return $aliments;
    }

    function addAliment(){
        $data = json_decode(file_get_contents('php://input'), true);
        
        $data['type'] = $data['type'] ?? 248;
        if(!isset($data['label'])){
            jsonMessage(400, "Missing label");
            return;
        }

        if(!is_numeric($data['type'])){
            jsonMessage(400, "Type should be a numeric ID");
            return;
        }

        $typeExist = executeSQLRequest("SELECT ID_TYPE FROM `type` WHERE ID_TYPE = ".$data['type']);
        if($typeExist == NULL){
            jsonMessage(404, "This type does not exist");
            return;
        }

        $result = executeSQLRequest("INSERT INTO `aliment` (LABEL, TYPE) VALUES ('".$data['label']."', ".$data['type']." )");
        $db_aliment = executeSQLRequest("SELECT aliment.ID_ALIMENT FROM `aliment` WHERE LABEL = '" .$data['label']. "' AND TYPE = '" .$data['type']. "'");
        jsonMessage(201, "Aliment has been created", ["Location" => $db_aliment]);
    }

    function updateAliment(){
        $data = json_decode(file_get_contents('php://input'), true);

        if(!isset($_GET['id']) OR !is_numeric($_GET['id'])){
            jsonMessage(400, "ID should be numeric");
        }
        $id  = $_GET['id'];

        $db_id = executeSQLRequest("SELECT ID_ALIMENT FROM `aliment` WHERE ID_ALIMENT = $id");
        if($db_id == NULL){
            jsonMessage(404, "ID does not exist");
        }

        if(!isset($data['label']) AND !isset($data['type'])){
            jsonMessage(400, "Missing parameter");
            return;
        }

        if(!is_numeric($data['type'])){
            jsonMessage(400, "Type should be a numeric ID");
            return;
        }

        $db_type = executeSQLRequest("SELECT ID_TYPE FROM `type` WHERE ID_TYPE = ".$data['type']);
        if($db_type == NULL){
            jsonMessage(404, "This type does not exist");
            return;
        }

        if(isset($data['label'])){
            $result = executeSQLRequest("UPDATE `aliment` SET `LABEL` = '" .$data['label']. "' WHERE aliment.ID_ALIMENT = $id");
        }
        if(isset($data['type'])){
            $result = executeSQLRequest("UPDATE `aliment` SET `TYPE` = '" .$data['type']. "' WHERE aliment.ID_ALIMENT = $id");
        }

        $db_aliment = executeSQLRequest("SELECT LABEL, TYPE FROM `aliment` WHERE ID_ALIMENT = $id");
        jsonMessage(200, "Aliment updated", ["Aliment" => $db_aliment]);
    }

    function deleteAliment(){
        $data = json_decode(file_get_contents('php://input'), true);

        if(!isset($_GET['id']) OR !is_numeric($_GET['id'])){
            jsonMessage(400, "ID should be numeric");
        }
        $id  = $_GET['id'];

        $db_id = executeSQLRequest("SELECT ID_ALIMENT FROM `aliment` WHERE ID_ALIMENT = $id");
        if($db_id == NULL){
            jsonMessage(404, "ID does not exist");
        }

        $result = executeSQLRequest("DELETE FROM `aliment` WHERE ID_ALIMENT = $id");
        jsonMessage(200, "Aliment deleted");
    }

    $reqMethod = $_SERVER['REQUEST_METHOD'];
    
    switch($reqMethod){
        case 'GET':
            chooseGetAliment();
            break;
        case 'POST':
            addAliment();
            break;
        case 'PUT':
            updateAliment();
            break;
        case 'DELETE':
            deleteAliment();
            break;
        default:
            jsonMessage(405, "Unauthorized Method");
    };

?>