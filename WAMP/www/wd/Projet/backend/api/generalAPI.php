<?php   
    require_once(__DIR__."/../config.php");
    require_once(__DIR__."/../sql/db_pdo.php");
    $pdo = getPDO();

    header("Content-type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Max-Age: 3600");


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

    //TO CHECK
    function isIdValide($array, $idField, $column, $table){
        if(!isset($array[$idField])){
            jsonMessage(400, "Missing Id");
            return false;
        }
        $id = $array[$idField];
        if(!is_numeric($id)){   //is_numérique renvoie false si chaine nulle
            jsonMessage(400, "Id is invalid");
            return false;
        }
        if(!doesValueExist($id, $column, $table)){
            jsonMessage(400, "Corresponding row does not exist");
            return false;
        }
        return true;
    }

    //TO CHECK
    function doesValueExist($value, $column, $table){
        $correspondingRow = executeSQLRequest("SELECT id_user FROM $table WHERE " .$column. " = '" . $value. "'");
        if($correspondingRow == null){
            return false;
        }
        return true;
    }
?>