<?php
    require_once("generalAPI.php");

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

        executeSQLRequest("INSERT INTO consommation (id_user, id_aliment, 'quantite', 'date')
                                VALUES ('".$consumption['id_user']."', '".$consumption['id_aliment']."', 
                                        '".$consumption['quantite']."', '".$consumption['date']."' )");

        $id = executeSQLRequest("SELECT id_conso from utilisateur where login = '" .$user['login']. "'");

        $id = $id[0]['id_user'];
        $json = ["location" => $id]; 
        jsonMessage(201, "User succesfully created", $json);
    }    
    function requestUpdateConsumption(){
        
    }
    function requestDeleteConsumtion(){
        
    }
    function requestGetCosumtion(){
        
    }   
    
    function getConsumtionTableColumns(){
        return array('id_user', 'id_aliment', 'quantite', 'date');
    }    


?>