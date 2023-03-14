<?php
    require_once("./tpl/tpl_head.php");
?>
<body>
    <header>
        <h1>Informations</h1>
    </header>
    <div class="container">
        <?php
            require_once("./tpl/tpl_nav.php");
            renderMenuToHTML('info');
        ?>
        <article>
            <div>
                <p>
                    Rien pour l'instant parce que j'ai pas d'inspi
                </p>
            </div>
        </article>
    </div>
</body>
<?php
    require_once("./tpl/tpl_footer.php");
?>
</html>