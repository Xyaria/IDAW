<?php
    echo '<div class="wrapper inscription hidden">';
    echo '<div class="bloc signin">
            <h3>Inscrivez-vous pour profiter de I-Manger Mieux</h3>
            <form onsubmit="event.preventDefault()">
                <table>
                    <tr>
                        <td>
                            <label for="userLogin">Login</label>
                            <br>
                            <input name="userLogin"/>
                        </td>
                        <td>
                            <label for="userSurname">Nom</label>
                            <br>
                            <input name="userSurname"/>
                        </td>
                        <td>
                            <label for="userSex">Sexe</label>
                            <br>
                            <select name="userSex">
                                <option value="">--Choisir une option--</option>
                                <option value="F">Femme</option>
                                <option value="H">Homme</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="userPassword">Mot de passe</label>
                            <br>
                            <input name="userPassword" type="password"/>
                        </td>
                        <td>
                            <label for="userName">Prénom</label>
                            <br>
                            <input name="userName"/>
                        </td>
                        <td>
                            <label for="userLevel">Niveau sportif</label>
                            <br>
                            <select name="userLevel">
                                <option value="">--Choisir une option--</option>
                                <option value="1">Bas</option>
                                <option value="2">Moyen</option>
                                <option value="3">Elevé</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="userPassword_confirm">Confirmer le mot de passe</label>
                            <br>
                            <input name="userPassword_confirm" type="password"/>
                        </td>
                        <td>
                            <label for="userBirthday">Date de naissance</label>
                            <br>
                            <input name="userBirthday" type="date"/>
                        </td>
                    </tr>
                </table>
                <input type="submit" value="Inscription" onclick=""/>
            </form>
        </div>
    </div>';
?>