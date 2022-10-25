<?php 

    require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "settings.php" ) ;
    require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "functions.php" ) ;
    require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "dbconn.php" ) ;

?>


<!DOCTYPE html>

<html lang="it">

    <?php get_assets($asset = "header", "Informativa privacy e cookie") ; ?>

    
    <body>
    
        <?php get_assets("navbar") ; ?>
        <?php get_assets("hero", "", "privacy" . DIRECTORY_SEPARATOR . "privacy") ; ?>
        <?php get_assets("content", "", "privacy" . DIRECTORY_SEPARATOR . "privacy") ; ?>
        <?php get_assets("footer") ; ?>
        <?php get_assets("subfooter") ; ?>
       
        

</html>