<?php
    require_once("./tpl/tpl_head.php");
?>
<body>
    <header>
        <h1>Projets</h1>
    </header>
    <div class="container">
        <?php
            require_once("./tpl/tpl_nav.php");
            renderMenuToHTML('projets');
        ?>
        <article>
            <div>
                <p>Lorem Ipsum dolor sit amet</p>
            </div>
        </article>
    </div>
</body>
<?php
    require_once("./tpl/tpl_footer.php");
?>
</html>