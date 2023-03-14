<?php
    function getHeader(string $currentPage){
        $format = ['accueil' => 'Accueil', 'cv' => 'Mon Cv', 'projets' => 'Projets'];
        echo '<body><header><h1>' .$format[$currentPage]. '</h1></header><div class="container">';
    }
?>