<?php
    require_once('../config.php');
    require_once('db_pdo.php');

    $pdo = getPDO();

    function intiDBStruct(){
        global $pdo;
        try {
            $sql = file_get_contents('../db/db_struct.sql');
            $request = $pdo->exec($sql);
            echo "DB initialisée";
        } catch (PDOException $erreur) {
            echo ('Erreur : '.$erreur->getMessage());
        }
    }

    function initDBData(){
        global $pdo;
        try {
            $sql = file_get_contents('../db/db_data.sql');
            $request = $pdo->exec($sql);
            echo "DB remplie";
        } catch (PDOException $erreur) {
            echo ('Erreur : '.$erreur->getMessage());
        }
    }

    function main(){
        global $pdo;
        $pdo->exec("SET FOREIGN_KEY_CHECKS=0");
        intiDBStruct();
        initDBData();
        $pdo->exec("SET FOREIGN_KEY_CHECKS=1");
    }

    main();
?>