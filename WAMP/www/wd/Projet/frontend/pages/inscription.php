<?php
    echo '<div class="wrapper connexion hidden">';
    echo '<div class="bloc connect">
            <h3>Connectez-vous pour accéder à votre espace</h3>
            <form onsubmit="event.preventDefault()">
                <label>Login</label>
                <br>
                <input/>
                <br>
                <label>Mot de passe</label>
                <br>
                <input type="password"/>
                <br>
                <input type="submit" value="Connexion"/>
            </form>
        </div>
    </div>';
}
?>