<?php
function renderMenuToHTML(string $currentPage) {
    $my_menu = ['index' => 'Accueil', 'cv' => 'CV', 'projets' => 'Projets', 'info' => 'Informations'];

    echo '<nav class="menu"><ul>';

    foreach($my_menu as $pageID => $pageTitle){
        echo '<li><a href="' .$pageID. '.php"';
        if($currentPage == $pageID){
            echo ' id="currentPage"';
        }
        echo '>' .$pageTitle. '</a></li>';
    }

    echo '</ul></nav>';
}

?>