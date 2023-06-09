<?php
    session_start();

    require_once("./tpl/tpl_head.php");
?>
<body>
    <div class="container">
        <?php
            userInit();

            require_once("./tpl/tpl_nav_guest.php");
            require_once("./tpl/tpl_nav.php");
            require_once("./tpl/tpl_footer.php");

            // ajouter les pages dynamiquement en fonction du menu cliqué
            require_once("./pages/dashboard.php");
            require_once("./pages/connexion.php");
            require_once("./pages/inscription.php");

            require_once("./pages/profile.php");
            displayPages();

            require_once("./pages/aliments.php");
            require_once("./pages/formulaire_repas.php");
            require_once("./pages/mes_repas.php");
        ?>
    </div>
</body>

<?php
    function userInit(){
        if(isset($_POST['disconnect']) AND $_POST['disconnect'] == true){
            session_unset();
            session_destroy();
        }

        if(isset($_POST['userId'])){
            $_SESSION['userSurname'] = $_POST['userSurname'];
            $_SESSION['userName'] = $_POST['userName'];
            $_SESSION['userMail'] = $_POST['userMail'];
            $_SESSION['userLogin'] = $_POST['userLogin'];
            $_SESSION['userBirthday'] = $_POST['userBirthday'];
            $_SESSION['userLevel'] = $_POST['userLevel'];
            $_SESSION['userSex'] = $_POST['userSex'];
            $_SESSION['id'] = $_POST['userId'];
        }
    }

    function displayPages(){
        $isConnected = isset($_SESSION['id']);
        tpl_nav($isConnected);
        tpl_nav_guest($isConnected);
        dashboard($isConnected);
        connexion($isConnected);
    }
// dashboard -> résumé, que les x derniers repas
// page "détails repas" -> toutes les conso + ajouter une conso
// page "parcourir aliments" -> tous les aliments + ajouter un aliment

/* A FAIRE :
- Réordonner main.js dans un script dashboard.js
- encapsuler les scripts dans des fonctions à appeler dans main.js
- ajouter la navigation (show/hide dans les fonctions principales des pages)*/
?>