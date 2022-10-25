<?php 

    require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "settings.php" ) ;
    require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "functions.php" ) ;
    require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "dbconn.php" ) ;

    $data = mc_middleware_call(constant("MIDDLEWARE_BASE_URL"), "/levi/homepage") ;

?>

<!DOCTYPE html>

<html lang="it">

    <head> 
        <?php get_assets("header", "", "Ricerca") ; ?>
    </head>

    <body>

    <body>
        <?php get_assets("navbar", null, null , $data["navbar"]) ; ?>

        <?php get_assets("search/search-hero", null, null , $data["hero"]) ; ?>

        <?php get_assets("search/search-content", null, null , $data, $conn) ; ?>

        <?php get_assets("footer", null, null , $data["footer"]) ; ?>

        <?php get_assets("subfooter", null, null , $data["subfooter"]) ; ?>
    </body>

</html>