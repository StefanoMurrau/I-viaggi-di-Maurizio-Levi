<?php 

    require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "settings.php" ) ;
    require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "functions.php" ) ;
    require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "dbconn.php" ) ;
?>

<!DOCTYPE html>

<html lang="it">
    <?php get_assets($asset = "header", "Contattaci") ; ?>


    <body>
        <?php get_assets("navbar") ; ?>
        <?php get_assets("hero", "", "contact-us" . DIRECTORY_SEPARATOR . "contact-us") ; ?>
        <?php get_assets("content", "", "contact-us" . DIRECTORY_SEPARATOR . "contact-us") ; ?>
        <?php get_assets("footer") ; ?>
        <?php get_assets("subfooter") ; ?>

</html>