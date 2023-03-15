<?php
function renderMenuToHTML(string $currentPage, string $language) {
    $my_menu_fr = ['accueil' => 'Accueil', 'cv' => 'CV', 'projets' => 'Projets', 'contact' => 'Contact'];
    $my_menu_en = ['accueil' => 'Home', 'cv' => 'CV', 'projets' => 'Projects', 'contact' => 'Contact'];

    $my_menu = ['fr' => $my_menu_fr, 'en' => $my_menu_en];

    echo '<nav class="menu"><ul>';

    foreach($my_menu[$language] as $pageID => $pageTitle){
        echo '<li><a href=index.php?page=' .$pageID. '&lang=' .$language;
        if($currentPage == $pageID){
            echo ' id=currentPage';
        }
        if($pageID){
            echo '>';
            echo $pageTitle;
            echo '</a></li>';
        }
    }

    echo '</ul><hr/>';

    $changeLang = ['fr' => 'Français', 'en' => 'English'];

    echo '<ul>';

    foreach($changeLang as $lang => $langue){
        echo '<li><a href=index.php?page=' .$currentPage. '&lang=' .$lang. '>' .$langue. '</a></li>';
    }
    
    echo '</ul></nav>';
}

?>