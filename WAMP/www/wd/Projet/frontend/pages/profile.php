<?php
    $userSurname = '';
    $userName = '';
    $userMail = '';
    $userLogin = '';
    $userBirthday = '';
    $userLevel = '';
    $userSex= '';
    echo '<div class="wrapper profile hidden">
        <div class="bloc user">
            <h1>Vos informations</h1>
            <hr/>
            <table class="informations">
                <tr>
                    <td>
                        <label>Nom</label>
                        <br/>
                        <span class="userInfo" id="userSurname">'.$userSurname.'</span>
                        <br/>
                    </td>
                    <td>
                        <label>Adresse Mail</label>
                        <br/>
                        <span class="userInfo" id="userMail">'.$userMail.'</span>
                    </td>
                    <td>
                        <label>Anniversaire</label>
                        <br/>
                        <span class="userInfo" id="userBirthday">'.$userBirthday.'</span>
                    </td>
                    <td>
                        <label>Niveau sportif</label>
                        <br/>
                        <span class="userInfo" id="userLevel">'.$userLevel.'</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Prénom</label>
                        <br/>
                        <span class="userInfo" id="userName">'.$userName.'</span>
                    </td>
                    <td>
                        <label>Pseudo</label>
                        <br/>
                        <span class="userInfo" id="userLogin">'.$userLogin.'</span>
                    </td>
                    <td>
                        <label>Sexe</label>
                        <br/>
                        <span class="userInfo" id="userSex">'.$userSex.'</span>
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
                            <label for="userSurname">Nom</label>
                            <br/>
                            <input name="userSurname"/>
                        </td>
                        <td>
                            <label for="userMail">Mail</label>
                            <br/>
                            <input name="userMail"/>
                        </td>
                        <td>
                            <label for="userBirthday">Anniversaire</label>
                            <br/>
                            <input name="userBirthday"/>
                        </td>
                        <td>
                            <label for="userLevel">Niveau sportif</label>
                            <br/>
                            <input name="userLevel"/>
                        </td>
                        <td>
                            <label for="userPassword_old">Ancien mot de passe</label>
                            <br/>
                            <input name="userPassword_old"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="userName">Prénom</label>
                            <br/>
                            <input name="userName"/>
                        </td>
                        <td>
                            <label for="userLogin">Pseudo</label>
                            <br/>
                            <input name="userLogin"/>
                        </td>
                        <td>
                            <label for="userSex">Sexe</label>
                            <br/>
                            <input name="userSex"/>
                        </td>
                        <td></td>
                        <td>
                            <label for="userPassword">Nouveau mot de passe</label>
                            <br/>
                            <input name="userPassword"/>
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