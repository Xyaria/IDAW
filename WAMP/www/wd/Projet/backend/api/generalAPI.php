<?php
    require_once("../sql/db_pdo.php");
    require_once("../config.php");
    
    header("Content-type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Max-Age: 3600");

    $pdo = getPDO();

    //TESTED
    function jsonMessage($status, $message, $other = NULL){
        http_response_code($status);
        $jsonMessage = ["status" => $status, "message" => $message];

        if(isset($other)){
            foreach($other as $key => $value){
                $jsonMessage[$key] = $value;
            }
        }

        echo json_encode($jsonMessage, JSON_UNESCAPED_UNICODE);
    }

    //TESTED
    function executeSQLRequest($SQLrequest){
        global$pdo;
        $request = $pdo->prepare($SQLrequest);
        $request->execute();
        return($request->fetchAll(PDO::FETCH_ASSOC));
    }

    //TESTED
    function isMissingRequiredValues($arrayToCheck, $requiredValues){
        if(countNonMissingRequiredValues($arrayToCheck, $requiredValues) != sizeof($requiredValues)){
            return true;
        }
        return false;
    }

    //TESTED
    function countNonMissingRequiredValues($arrayToCheck, $requiredValues){
        $nonMissingValues = 0;
        foreach($requiredValues as $value){
            if(isset($arrayToCheck[$value])){
                $nonMissingValues += 1;
            }
        }
        return $nonMissingValues;
    }

    //TESTED
    function doesIdExist($id){
        return doesUserIdExist($id, "id_user");
    }

    //TESTED
    function doesUserIdExist($value, $field){
        $correspondingUser = executeSQLRequest("SELECT id_user FROM utilisateur WHERE " .$field. " = '" . $value. "'");
        if($correspondingUser == null){
            return false;
        }
        return true;
    }
?>