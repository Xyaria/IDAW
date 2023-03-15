<?php
    function getHeader(string $currentPage, $language){
        $format_fr = ['accueil' => 'Accueil', 'cv' => 'Mon Cv', 'projets' => 'Projets', 'contact' => 'Me contacter'];
        $format_en = ['accueil' => 'Home', 'cv' => 'My Cv', 'projets' => 'Projects', 'contact' => 'Contact Me'];

        //$format = ['fr' => $format_fr, 'en' => $format_en];
        $format = ${'format_' .$language};

        echo '<body><header><h1>' .$format[$currentPage]. '</h1></header><div class="container">';
    }
?>