<?php
    require_once("./tpl/tpl_head.php");
?>
<body>
    <div class="container">
        <?php
            require_once("./tpl/tpl_nav.php");

            // ajouter les pages dynamiquement en fonction du menu cliqué
            //require_once("./pages/dashboard.php");
            require_once("./pages/profile.php");
            require_once("./tpl/tpl_footer.php");
        ?>
    </div>
</body>