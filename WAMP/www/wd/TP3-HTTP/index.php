<!DOCTYPE html>
<?php
    setcookie("chosen_style",);
    require_once("login.php");
    require_once("connected.php");
    $style = $_COOKIE['chosen_style'];
?>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-type">
    <title>Mon site tout beau</title>
    <?php
        echo '<link href="./css/' .$style. '.css" type="text/css" rel="stylesheet">'
    ?>
    <link href="" rel="favicon">
    <script src=""></script>
</head>
<body>
    <form id="style_form" action="index.php" method="GET">
        <select name="css">
            <option name="css" value="style1">style1</option>
            <option name="css" value="style2">style2</option>
        </select>
        <input type="submit" value="Appliquer" />
    </form>
<?php
    if(isset($_GET['css'])){
        $style = $_GET['css'];
    }
    setcookie("chosen_style", $style);
?>
</body>
</html>