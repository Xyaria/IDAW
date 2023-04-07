<?php 
    function tpl_nav_guest($isConnected){
        if($isConnected){
            echo '<div class="sidebar hidden">';
        }
        else{
            echo '<div class="sidebar">';
        }
        echo 
        '<nav>
            <div class="profil">
                <img src="./assets/logo.png"/>
                <h3>Bienvenue</h3>
                <p>Connectez-vous pour accéder au site</p>
            </div>
            <ul class="nav">
                <li>
                    <a class="nav connexion active">
                        <span class="icon"><i class="fa-solid fa-right-to-bracket"></i></span>
                        <span class="nav_item">Connexion</span>
                    </a>
                </li>
                <li>
                    <a class="nav inscription">
                        <span class="icon"><i class="fa-solid fa-user-plus"></i></span>
                        <span class="nav_item">Inscription</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>';
    }
?>
