<?php
function connexion($isConnected){
    if($isConnected){
        echo '<div class="wrapper connexion hidden">';
    }
    else{
        echo '<div class="wrapper connexion">';
    }
    echo '<div class="bloc connect">
            <h3>Connectez-vous pour accéder à votre espace</h3>
            <form onsubmit="event.preventDefault()">
                <label for="userLogin">Login</label>
                <br>
                <input name="userLogin"/>
                <br>
                <label for="userPassword">Mot de passe</label>
                <br>
                <input name="userPassword" type="password"/>
                <br>
                <input type="submit" value="Connexion"/>
            </form>
        </div>
    </div>';
}
?>