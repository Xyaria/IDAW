<?php
    $userName = '';
    $userMail = '';
    echo '<div class="wrapper profile hidden">
        <div class="bloc user">
            <h1>Vos informations</h1>
            <hr/>
            <table class="informations">
                <tr>
                    <td>
                        <label>Nom d\'utilisateur</label>
                        <br/>
                        <span class="userInfo" id="userName">JeanBili</span>
                        <br/>
                    </td>
                    <td>
                        <label>Nombre de jours suivit</label>
                        <br/>
                        <span class="userInfo" id="userTrackedDays">8</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Adresse e-mail</label>
                        <br/>
                        <span class="userInfo" id="userMail">jean@bili.com</span>
                    </td>
                    <td>
                        <label>Nombre de repas entrés</label>
                        <br/>
                        <span class="userInfo" id="userTrackedMeals">24</span>
                    </td>
                </tr>
                
            </table>
        </div>
        <div class="bloc modify">
            <h1>Modifier le profil</h1>
            <hr/>
            <form onsubmit="event.preventDefault()">
                <table class="form">
                    <tr>
                        <td>
                            <label>Nom d\'utilisateur</label>
                            <br/>
                            <input/>
                        </td>
                        <td>
                            <label>Ancien mot de passe</label>
                            <br/>
                            <input/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>E-mail</label>
                            <br/>
                            <input/>
                        </td>
                        <td>
                            <label>Nouveau mot de passe</label>
                            <br/>
                            <input/>
                        </td>
                    </tr>
                </table>
                <input type="submit" value="Enregistrer"/>
            </form>
        </div>
        <div class="bloc delete">
            <h1>Supprimer le compte</h1>
            <hr/>
            <div>
                <p>Attention ! Cette action est irréversible. La suppression de votre compte entraîne la suppression de toute information concernant les repas entrés et toute statistique.</p>
                <button class="red" onclick="window.prompt(\'Êtes-vous sûr de vouloir supprimer votre compte ? Entrez votre mot de passe pour confirmer la suppression\')">Supprimer mon compte</button>
            </div>
                <!-- Mettre un pop-up de confirmation où il faut entrer le mot de passe pour confirmer la suppression -->
        </div>
    </div>';
?>