<?php
    session_start();

    require_once("./tpl/tpl_head.php");
?>
<body>
    <div class="container">
        <?php
            require_once("./tpl/tpl_nav_guest.php");
            require_once("./tpl/tpl_nav.php");

            // ajouter les pages dynamiquement en fonction du menu cliqué
            require_once("./pages/dashboard.php");
            require_once("./pages/connexion.php");

            require_once("./pages/profile.php");
            displayPages();

            require_once("./pages/mes_repas.php");
            require_once("./pages/aliments.php");

            require_once("./tpl/tpl_footer.php");


        ?>
    </div>
</body>
<script>
const nav = document.querySelectorAll(".nav");
    const pages = document.querySelectorAll(".wrapper");

function goToPage(pageLink){
    nav.forEach(nav_item => {
        nav_item.classList.remove("active");
        console.log("Removed active");
    });
    pages.forEach(page => {
        page.classList.add("hidden");
        console.log("Hidden all");
    })
    $(pageLink).addClass("active");
    console.log("Added active to " + pageLink.classList);
    // ajouter affichage de la page de destination
}
</script>

<?php
    function displayPages(){
        $isConnected = false;//isset($_SESSION['id_user']);
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