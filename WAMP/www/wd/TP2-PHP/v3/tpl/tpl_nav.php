<?php
function renderMenuToHTML(string $currentPage) {
    $my_menu = ['accueil' => 'Accueil', 'cv' => 'CV', 'projets' => 'Projets'];

    echo '<nav class="menu"><ul>';

    foreach($my_menu as $pageID => $pageTitle){
        echo '<li><a href=index.php?page=' .$pageID;
        if($currentPage == $pageID){
            echo ' id=\"currentPage\"';
        }
        if($pageID){
            echo '>';
            echo $pageTitle;
            echo '</a></li>';
        }
    }

    echo '</ul></nav>';
}

?>