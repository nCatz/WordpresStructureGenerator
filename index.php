<?php
    require_once("generator.php");

    if (isset($_GET['download'])) {
        $id = $_GET['download'];
        generateZip($id);
    } else {
        $id = 151236;
    }

?>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="css/materialize.css">
    </head>
    <body> You'll have 24-48 hours to download it with this link: 
        <a href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."?download=$id";?>"><?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."?download=$id";?></a>
    </body>
</html>