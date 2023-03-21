<?php
    require_once("../config.php");
    require_once("../DB/db_pdo.php");
    $pdo = getPDO();

    function error($status, $message){
        http_response_code($status);
        $error = ["status" => $status, "message" => $message];
        echo json_encode($error);
    }

    function getUserID($user){
        global $pdo;
        $request = $pdo->prepare("SELECT `id` FROM users WHERE `name` = '" .$user['nom']. "' AND `mail` = '" .$user['mail']. "'");
        $request->execute();
        $user = $request->fetch();
        return $user['id'];
    }

    function getUserByID($id){
        global $pdo;
        $request = $pdo->prepare("SELECT * FROM users WHERE `id` = '" .$id. "'");
        $request->execute();
        return $request->fetch();
    }

    function getUsers(){
        global $pdo;

        if(isset($_SERVER['PATH_INFO'])){
            $user = getUserByID($_SERVER['PATH_INFO']);
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
            error(400, "Missing parameter");
            return;
        }

        $id = getUserID($user);

        if($id != NULL){
            error(303, "User already exist, location: http://localhost/wd/TP4-REST/API/users.php/" .$id);
            return;
        }

        $request = $pdo->prepare("INSERT INTO `users` (`name`, `mail`) VALUES ('" .$user['nom']. "', '" .$user['mail']. "')");
        $request->execute();

        $id = getUserID($user);
        
        header("Location: http://localhost/wd/TP4-REST/API/users.php/" .$id);
    }

    function updateUsers(){
        global $pdo;

        if(!isset($_SERVER['PATH_INFO'])){
            error(400, "Missing user ID");
            return;
        }
        $id = substr($_SERVER['PATH_INFO'], 1);

        $db_user = getUserByID($id);
        if($db_user == NULL){
            error(404, "User doesn't exist");
            return;
        }

        $user = json_decode(file_get_contents("php://input"), true);

        if(!isset($user['nom']) AND !isset($user['mail'])){
           error(400, "Missing parameter");
           return;
        }

        $reqBody = NULL;
        if($user['nom'] != NULL){
            $reqBody = "`name`='" .$user['nom']. "'";
        }
        if($user['mail'] != NULL){
            if($reqBody !== NULL){
                $reqBody .= ", `mail`='" .$user['mail']. "'";
            }
            else{
                $reqBody = "`mail`='" .$user['mail']. "'";
            }
        }
        $request = $pdo->prepare("UPDATE `users` SET ".$reqBody." WHERE `id`=" .$id);
        $request->execute();

        header("Location: http://localhost/wd/TP4-REST/API/users.php/" .$id);
    }

    function deleteUsers(){
        global $pdo;

        if(!isset($_SERVER['PATH_INFO'])){
            error(400, "Missing user ID");
            return;
        }
        $id = substr($_SERVER['PATH_INFO'], 1);

        $db_user = getUserByID($id);
        if($db_user == NULL){
            error(404, "User doesn't exist");
            return;
        }

        $request = $pdo->prepare("DELETE FROM `users` WHERE `id`=" .$id);
        $request->execute();
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
            echo "405 - Unauthorized Method";
    };
?>