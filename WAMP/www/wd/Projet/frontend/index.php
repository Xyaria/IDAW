<?php
    session_start();

    require_once("./tpl/tpl_head.php");
?>
<body>
    <div class="container">
        <?php
            require_once("./tpl/tpl_navUnconnected.php");
            require_once("./tpl/tpl_nav.php");

            // ajouter les pages dynamiquement en fonction du menu cliqué
            require_once("./pages/dashboard.php");
            require_once("./pages/connection.php");

            require_once("./pages/profile.php");
            displayPages();

            require_once("./pages/mes_repas.php");
            require_once("./pages/aliments.php");

            require_once("./tpl/tpl_footer.php");


        ?>
    </div>
</body>

<?php
    function displayPages(){
        $isConnected = isset($_SESSION['id_user']);
        tpl_nav($isConnected);
        tpl_navUnconnected($isConnected);
        dashboard($isConnected);
        connection($isConnected);
    }
// dashboard -> résumé, que les x derniers repas
// page "détails repas" -> toutes les conso + ajouter une conso
// page "parcourir aliments" -> tous les aliments + ajouter un aliment

/* A FAIRE :
- Réordonner main.js dans un script dashboard.js
- encapsuler les scripts dans des fonctions à appeler dans main.js
- ajouter la navigation (show/hide dans les fonctions principales des pages)*/
?>