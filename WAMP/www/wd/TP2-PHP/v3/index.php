<?php
    require_once("./tpl/tpl_head.php");

    if(isset($_GET['page'])) {
        $currentPage = $_GET['page'];
    }

    if(isset($_GET['lang'])) {
        $language = $_GET['lang'];
    }

    require_once("./tpl/tpl_bandeau.php");
    getHeader($currentPage, $language);
    
    require_once("./tpl/tpl_nav.php");
    renderMenuToHTML($currentPage, $language);
?>
        <article>
            <?php
                $pageCore = "$language/$currentPage.php";
                if(is_readable($pageCore)) {
                    require_once($pageCore);
                }
                else {
                    require_once("error.php");
                }
            ?>
        </article>
    </div>
</body>
<?php
    require_once("./tpl/tpl_footer.php");
?>
</html>