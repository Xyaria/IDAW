<?php
    require_once("./tpl/tpl_head.php");
?>
<body>
    <header>
        <h1>Accueil</h1>
    </header>
    <div class="container">
        <?php
            require_once("./tpl/tpl_nav.php");
            renderMenuToHTML('index');
        ?>
        <article>
            <div>
                <h3>Bonjour et bienvenue !</h3>
                <img src="./img/random_pic.jpg" alt="Salle d'attente"/>
                <p>Installez-vous, les sièges sont gratuits :)</p>
                <p>Pas les boissons du distributeur pas contre</p>
                <p><em>Parce qu'il n'y en a pas</em></p>
            </div>
        </article>
    </div>
</body>
<?php
    require_once("./tpl/tpl_footer.php");
?>
</html>