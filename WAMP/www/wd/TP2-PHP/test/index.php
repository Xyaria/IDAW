<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-type">
    <title>Affichons l'heure, voulez-vous</title>
    <!--<link href="path/to/css" type="text/css" rel="stylesheet">
    <script src="path/to/script"></script>-->
</head>
<body>
    <div>
        <?php
            function modular_date(string $timezone){
                date_default_timezone_set($timezone);
                echo date("d/m/Y h:i:s");
            }

            modular_date("Europe/Paris");
        ?>
    </div>



</body>
</html>