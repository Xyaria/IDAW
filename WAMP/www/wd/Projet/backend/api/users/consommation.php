<?php
/*
*GLOBAL TODO
*
*OPTIONAL:
*high scale factorisation for update, delete and new row functions
*
*/
    require_once("../generalAPI.php");

    function main(){        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            requestNewConsumption();
            return;
        }
        if($_SERVER['REQUEST_METHOD'] == 'PUT'){
            requestUpdateConsumption();
            return;
        }
        if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
            requestDeleteConsumption ();
            return;
        }            
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            requestGetConsumption();
            return;
        }    
        else{
            jsonMessage(400, "Bad request");
            return;
        }
    }

    //TESTED
    function requestNewConsumption(){
        $requiredValues= getConsumptionTableColumns();
        $consumption = json_decode(file_get_contents("php://input"), true);
        $consumption = $consumption[0];
        
        if(!isIdValide($consumption, 'id_user', 'id_user', 'utilisateur')){
            return;
        }
        if(!isIdValide($consumption, 'id_aliment', 'id_aliment', 'aliment')){ 
            return;
        }  
        if(isMissingRequiredValues($consumption, $requiredValues)){
            jsonMessage(400, "Missing values");
            return;
        }
        executeSQLRequest("INSERT INTO consomme (id_user, id_aliment, quantite, date)
                                VALUES ('".$consumption['id_user']."', '".$consumption['id_aliment']."', 
                                        '".$consumption['quantite']."', '".$consumption['date']."' )");

        $id = executeSQLRequest("SELECT id_conso FROM consomme WHERE id_user = '".$consumption['id_user']."'
                             AND id_aliment = '".$consumption['id_aliment']."' AND quantite = '".$consumption['quantite']."'
                             AND date = '".$consumption['date']."'");

        $id = $id[0]['id_conso'];
        $json = ["location" => $id]; 
        jsonMessage(201, "Consumption succesfully added", $json);
    } 

    //TESTED
    function requestUpdateConsumption(){
        $requiredValues= getConsumptionTableColumns();
        $consumption = json_decode(file_get_contents("php://input"), true);
        $consumption = $consumption[0];
        
        if(!isIdValide($consumption, 'id_conso', 'id_conso', 'consomme')){
            return;
        }
        if(isset($consumption['id_aliment'])){
            if(!doesValueExist($consumption['id_aliment'], 'id_aliment', 'aliment')){
                jsonMessage(400, "Aliment does not exist");
                return;
            }
        }
        if(countNonMissingRequiredValues($consumption, $requiredValues) == 0){
            jsonMessage(400, "No values updated");
            return;
        }
        
        //can execute request
        $sqlRequest = "UPDATE consomme SET ";
        foreach($consumption as $field => $value){
            if($field != 'id_conso'){
                $sqlRequest .= $field ." = '". $value . "', ";
            }
        }
        $sqlRequest = substr($sqlRequest, 0, strlen($sqlRequest)-2);
        $sqlRequest .= " WHERE id_conso = " . $consumption['id_conso'];

        executeSQLRequest($sqlRequest);
        jsonMessage(200, "consumption succesfully updated"); 
    }

    //TESTED 
    function requestDeleteConsumption(){
        $consumption = json_decode(file_get_contents("php://input"), true);
        $consumption = $consumption[0];
        if(!isIdValide($consumption, 'id_conso', 'id_conso', 'consomme')){
            return;
        }

        //can execute request
        executeSQLRequest("DELETE FROM consomme WHERE id_conso = '" .$consumption['id_conso']. "'");
        jsonMessage(200, "Consumption succesfully deleted");
        
    }

    //TESTED
    function requestGetConsumption(){
        if(!isIdValide($_GET, 'id', 'id_conso', 'consomme')){
            return;
        }
        if(isset($_GET['last'])){
            requestGetLastXConsumption($_GET['last'], $_GET['id']);
            return;
        }
        if(isset($_GET['from']) && isset($_GET['to'])){
            requestGetFromToConsumption($_GET['from'], $_GET['to'],  $_GET['id']);
            return;
        }
        else{
            requestGetLastXConsumption('all', $_GET['id']);;
        }
    }   
    
    //TESTED
    function requestGetLastXConsumption($number, $id_user){
        if(!is_numeric($number) && $number != 'all'){
            jsonMessage(400, "Parameter is not a number");
            return;
        }

        $request = "SELECT id_aliment, quantite, date FROM consomme WHERE id_user = '" .$id_user. "'
        ORDER BY date desc";
        if($number != 'all'){
            $request .= " LIMIT " .$number;
        }
        $lastConsumptions = executeSQLRequest($request);

        jsonMessage(201, "Success", $lastConsumptions);
    }  
    
    //TESTED
    function requestGetFromToConsumption($from, $to, $id_user){
        if(!is_numeric($from) || !is_numeric($to)){
            jsonMessage(400, "Parameter is not a number");
            return;
        }
        $consumptions = executeSQLRequest("SELECT id_aliment, quantite, date FROM consomme WHERE id_user = '" .$id_user. "'
                            ORDER BY date desc LIMIT " . $from-1 . ", " .$to-$from+1);
        jsonMessage(201, "Success", $consumptions);
    }

    //TESTED
    function getConsumptionTableColumns(){
        return array('id_aliment', 'quantite', 'date');
    }    

    main();
?>