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
            <form onsubmit="event.preventDefault(); connexion_getValues();">
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
            <form id="hidden_form" method="POST">
                <input name="userLogin" type="hidden"/>
                <input name="userId" type="hidden"/>
                <input name="userSurname" type="hidden"/>
                <input name="userSex" type="hidden"/>
                <input name="userPassword" type="hidden"/>
                <input name="userName" type="hidden"/>
                <input name="userLevel" type="hidden"/>
                <input name="userMail" type="hidden"/>
                <input name="userBirthday" type="hidden"/>
            </form>
        </div>
    </div>';
}
?>