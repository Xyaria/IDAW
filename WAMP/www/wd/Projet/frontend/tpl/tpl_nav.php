<?php 
function tpl_nav($isHidden){
    if($isHidden){
        echo '<div class="sidebar hidden">';
    }
    else{
        echo '<div class="sidebar">';
    }
    echo 
    '<nav>
            <div class="profil">
                <img src="./assets/logo.png"/>
                <h3>Nom d\'utilisateur</h3>
                <p>Sous-titre si besoin</p>
            </div>
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fa-solid fa-chart-line"></i></span>
                        <span class="nav_item">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fa-solid fa-utensils"></i></span>
                        <span class="nav_item">Mes Repas</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fa-solid fa-carrot"></i></span>
                        <span class="nav_item">Tous les aliments</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fa-solid fa-user"></i></span>
                        <span class="nav_item">Profil</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fa-solid fa-gear"></i></span>
                        <span class="nav_item">Paramètres</span>
                    </a>
                </li>
            </ul>
        </nav>

    </div>';
    }
?>