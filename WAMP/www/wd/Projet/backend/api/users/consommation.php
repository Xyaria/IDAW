<?php
/*
*GLOBAL TODO
*
*OPTIONAL:
*high scale factorisation for update, delete and new row functions
*
*/
    require_once("../general    API.php");

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
            requestGetConsumtion();
            return;
        }    
        else{
            jsonMessage(400, "Bad request");
            return;
        }
    }

    //TO TEST
    function requestNewConsumption(){
        $requiredValues= getConsumtionTableColumns();
        $consumption = json_decode(file_get_contents("php://input"), true);
        $consumption = $consumption[0];
        
        if(!isIdValide($consumption, 'id_user', 'id_user', 'utilisateur')){
            return;
        }
        if(!isIdValide($consumption, 'id_aliment', 'id_aliment', 'aliment')){
            return;
        }
        if(isMissingRequiredValues($user, $requiredValues)){
            jsonMessage(400, "Missing values");
            return;
        }

        executeSQLRequest("INSERT INTO consomme (id_user, id_aliment, 'quantite', 'date')
                                VALUES ('".$consumption['id_user']."', '".$consumption['id_aliment']."', 
                                        '".$consumption['quantite']."', '".$consumption['date']."' )");

        $id = executeSQLRequest("SELECT id_conso FROM consomme WHERE id_user = '".$consumption['id_user']."'
                                AND id_aliment = '".$consumption['id_aliment']."' AND quantite = '".$consumption['quantite']."'
                                AND date = '".$consumption['date']."'");

        $id = $id[0]['id_conso'];
        $json = ["location" => $id]; 
        jsonMessage(201, "Consumption succesfully added", $json);
    }  

    //TO TEST
    function requestUpdateConsumption(){
        $requiredValues= getConsumptionTableColumns();
        $consumption = json_decode(file_get_contents("php://input"), true);
        $consumption = $consumption[0];
        
        if(!isIdValide($consumption, 'id_conso', 'id_conso', 'consomme')){
            return;
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

    //TO TEST 
    function requestDeleteConsumtion(){
        $consumption = json_decode(file_get_contents("php://input"), true);
        $consumption = $consumption[0];
        if(!isIdValide($consumption, 'id_conso', 'id_conso', 'consomme')){
            return;
        }

        //can execute request
        executeSQLRequest("DELETE FROM consomme WHERE id_conso = '" .$consumption['id_conso']. "'");
        jsonMessage(200, "Consumption succesfully deleted");
        
    }

    //TO TEST
    function requestGetConsumtion(){        
        $body = json_decode(file_get_contents("php://input"), true);
        $body = $consumption[0];
        if(!isIdValide($body, 'id_conso', 'id_conso', 'consomme')){
            return;
        }
        if(isset($_GET['last'])){
            requestGetLastXConsumtion($_GET['last']);
            return;
        }
        if(isset($_GET['from']) && isset($_GET['to'])){
            requestGetFromToConsumption($_GET['from'], $_GET['to']);
            return;
        }
    }   
    
    //TO TEST
    function requestGetLastXConsumption($number, $id_user){
        if(!is_numeric($number)){
            //error parametres
            return;
        }

        $lastConsumptions = executeSQLRequest("SELECT id_aliment, quantite, date FROM consomme WHERE id_user = '" .$id_user. "'
                            ORDER BY date desc LIMIT " .$number);

        print_r($lastConsumptions);
    }  
    
    //TO TEST
    function requestGetFromToConsumption($from, $to){
        if(!is_numeric($from) || !is_numeric($to)){
            //error parametres
            return;
        }
        $consumptions = executeSQLRequest("SELECT id_aliment, quantite, date FROM consomme WHERE id_user = '" .$id_user. "'
                            ORDER BY date desc LIMIT " . $from-1 . ", " .$to-$from);

        print_r($consumption);
    }

    //TO TEST
    function getConsumtionTableColumns(){
        return array('id_user', 'id_aliment', 'quantite', 'date');
    }    
?>