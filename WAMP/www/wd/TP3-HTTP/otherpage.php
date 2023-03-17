<?php
    session_start();
    echo $_SESSION['login']. "<br/>";
    echo $_SESSION['password']. "<br/>";
?>
<form action="index.php" method="POST">
    <input id="disconnect" type="submit" name="disconnect" value="Déconnexion"/>
</form>