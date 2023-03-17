<?php
    $users = array(
    'riri' => 'fifi',
    'yoda' => 'maitrejedi');

    $login = "anonymous";
    $errorText = "";
    $successfullyLogged = false;

    if(isset($_POST['login']) && isset($_POST['password'])) {
        $tryLogin=$_POST['login'];
        $tryPwd=$_POST['password'];
        
        if(array_key_exists($tryLogin, $users) && $users[$tryLogin]==$tryPwd) {
            $successfullyLogged = true;
            // $login = $tryLogin;
            $_SESSION['login'] = $tryLogin;
            $_SESSION['password'] = $tryPwd;
        } 
        else {
            $errorText = "Erreur de login/password";
        }
    } 
    else {
        $errorText = "Merci d'utiliser le formulaire de login";
    }

    if(!$successfullyLogged) {
        echo "<br/>" .$errorText;
    } 
    else {
        echo "<h1>Bienvenue ".$_SESSION['login']."</h1>";
        echo '<style>
        #login_form {
            display: none !important;
        }
        
        a, #disconnect {
            display: block !important;
        }
        </style>';
    }
?>

<a href="otherpage.php">Autre page</a>
<form action="index.php" method="POST">
    <input id="disconnect" type="submit" name="disconnect" value="Déconnexion"/>
</form>