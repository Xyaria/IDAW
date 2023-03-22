<?php
    require_once("../config.php");
    require_once("../DB/db_pdo.php");

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

    function checkID($id){
        if(is_numeric($id)){
            return true;
        }
        return false;
    }

    function getUserByValues($user){
        global $pdo;
        $request = $pdo->prepare("SELECT `id` FROM users WHERE `name` = '" .$user['nom']. "' AND `mail` = '" .$user['mail']. "'");
        $request->execute();
        $user = $request->fetch();
        return $user;
    }

    function getUserByID($id){
        global $pdo;
        $request = $pdo->prepare("SELECT * FROM users WHERE `id` = '" .$id. "'");
        $request->execute();
        $user = $request->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    function getUsers(){
        global $pdo;

        if(isset($_SERVER['PATH_INFO'])){
            $id = substr($_SERVER['PATH_INFO'], 1);

            if(!checkID($id)){
                http_response_code(400);
                jsonMessage(400, "ID should be numeric");
                return;
            }

            $user = getUserByID($id);
            if(!$user){
                jsonMessage(404, "User not found");
                return;
            }

            echo json_encode($user);
            return;
        }

        $request = $pdo->prepare("SELECT * FROM users");
        $request->execute();
        $users = $request->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($users);
    }

    function addUsers(){
        global $pdo;
        $user = json_decode(file_get_contents("php://input"), true);

        if(!isset($user['nom']) OR !isset($user['mail'])){
            jsonMessage(400, "Missing parameter");
            return;
        }

        $db_user = getUserByValues($user);
        if($db_user != NULL){
            jsonMessage(303, "User already exist", ["Location" => _API_PATH."/users.php/$id"]);
            return;
        }

        $request = $pdo->prepare("INSERT INTO `users` (`name`, `mail`) VALUES ('" .$user['nom']. "', '" .$user['mail']. "')");
        $request->execute();

        $user = getUserByValues($user);
        $id = $user['id'];
        
        jsonMessage(201, "User has been created", ["Location" => _API_PATH."/users.php/$id"]);
    }

    function updateUsers(){
        global $pdo;

        if(!isset($_SERVER['PATH_INFO'])){
            jsonMessage(400, "Missing user ID");
            return;
        }
        $id = substr($_SERVER['PATH_INFO'], 1);

        $db_user = getUserByID($id);
        if($db_user == NULL){
            jsonMessage(404, "User doesn't exist");
            return;
        }

        $user = json_decode(file_get_contents("php://input"), true);

        if(!isset($user['nom']) AND !isset($user['mail'])){
           jsonMessage(400, "Missing parameter");
           return;
        }

        echo $db_user['mail'], $user['mail'];

        if((($db_user['name'] === $user['nom']) OR (!isset($user['nom']))) AND (($db_user['mail'] === $user['mail']) OR (!isset($user['mail'])))){
            jsonMessage(200, "Same informations already exists for this user");
            return;
        }

        $reqBody = "";
        if(isset($user['nom'])){
            $reqBody = "`name`='" .$user['nom']. "'";
        }
        if(isset($user['mail'])){
            if($reqBody === ""){
                $reqBody = "`mail`='" .$user['mail']. "'";
            }
            else{
                $reqBody .= ", `mail`='" .$user['mail']. "'";
            }
        }
        $request = $pdo->prepare("UPDATE `users` SET ".$reqBody." WHERE `id`=" .$id);
        $request->execute();

        jsonMessage(200, "User has been updated", ["Location" => _API_PATH."/users.php/" .$id]);
    }

    function deleteUsers(){
        global $pdo;

        if(!isset($_SERVER['PATH_INFO'])){
            jsonMessage(400, "Missing user ID");
            return;
        }
        $id = substr($_SERVER['PATH_INFO'], 1);

        $db_user = getUserByID($id);
        if($db_user == NULL){
            jsonMessage(404, "User doesn't exist");
            return;
        }

        $request = $pdo->prepare("DELETE FROM `users` WHERE `id`=" .$id);
        $request->execute();
        jsonMessage(200, "User has been deleted");
    }

    $reqMethod = $_SERVER['REQUEST_METHOD'];
    
    switch($reqMethod){
        case 'GET':
            getUsers();
            break;
        case 'POST':
            addUsers();
            break;
        case 'PUT':
            updateUsers();
            break;
        case 'DELETE':
            deleteUsers();
            break;
        default:
            jsonMessage(405, "Unauthorized Method");
    };
?>