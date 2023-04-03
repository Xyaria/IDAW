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
        
        if(!isIdValide($consumption)){()
            return;
        }
        if(countNonMissingRequiredValues($user, $requiredValues) == 0){
            jsonMessage(400, "No values updated");
            return;
        }
    }    
    function requestUpdateConsumption(){
        
    }
    function requestDeleteConsumtion(){
        
    }
    function requestGetCosumtion(){
        
    }   

    function isIdValide($consumption){

        if(!isset($consumption['id_user'])){
            jsonMessage(400, "Missing Id");
            return false;
        }
        $id = $consumption['id_user'];
        if(!is_numeric($id)){   //is_numérique renvoie false si chaine nulle
            jsonMessage(400, "Id is invalid");
            return false;
        }
        if(!doesIdExist($id)){
            jsonMessage(400, "Consumption does not exist");
            return false;
        }
        return true;
    }
    
    function doesFoodIdExist($value, $field){
        $correspondingUser = executeSQLRequest("SELECT id_user FROM aliment WHERE " .$field. " = '" . $value. "'");
        if($correspondingUser == null){
            return false;
        }
        return true;
    }
    
    function getConsumtionTableColumns(){
        return array('id_user', 'id_aliment', 'quantite', 'date');
    }    


?>