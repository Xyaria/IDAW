<?php
    require_once("./tpl/tpl_head.php");
?>
<body>
    <header>
        <h1>Mon CV</h1>
    </header>
    <div class="container">
        <?php
            require_once("./tpl/tpl_nav.php");
            renderMenuToHTML('cv');
        ?>
        <article>
            <div>
                <p>un jour je mettrai un cv</p>
                <p>il sera là et il sera beau</p>
                <p><em>peut-être </em></p>
            </div>
        </article>
    </div>
</body>
<?php
    require_once("./tpl/tpl_footer.php");
?>
</html>