<!DOCTYPE html>
<?php
    session_start();
    if(isset($_COOKIE['chosen_style'])){
        $style = $_COOKIE['chosen_style'];
    }

    if(isset($_GET['css'])){
        $style = $_GET['css'];
    }
    else {
        $style = 'style1';
    }
    setcookie("chosen_style", $style);

    if(isset($_POST['disconnect'])){
        session_unset();
        session_destroy();
    }
?>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-type">
    <title>Mon site tout beau</title>
    <link href="./css/baseStyle.css" type="text/css" rel="stylesheet">
    <?php
        echo '<link href="./css/' .$style. '.css" type="text/css" rel="stylesheet">'
    ?>
    <link href="" rel="favicon">
</head>
<body>
    <?php
        require_once("login.php");
        require_once("connected.php");
    ?>
    <br>
    <form id="style_form" action="index.php" method="GET">
        <select name="css">
            <option value="style1">style1</option>
            <option value="style2">style2</option>
        </select>
        <input type="submit" value="Appliquer"/>
    </form>
</body>
</html>