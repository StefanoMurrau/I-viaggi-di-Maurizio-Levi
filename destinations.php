<?php 

    require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "settings.php" ) ;
    require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "functions.php" ) ;
    require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "dbconn.php" ) ;

?>


<!DOCTYPE html>

<html lang="it">

    <?php get_assets($asset = "header", "Destinazioni") ; ?>

    
    <body>
    
        <?php get_assets("navbar") ; ?>
        <?php get_assets("hero", "", "destinations" . DIRECTORY_SEPARATOR . "destinations", $conn) ; ?>
        <?php get_assets("info", "", "destinations" . DIRECTORY_SEPARATOR . "destinations") ; ?>
        <?php get_assets("nations", "", "destinations" . DIRECTORY_SEPARATOR . "destinations", $conn) ; ?> 
        <?php get_assets("additional-info") ; ?>
        <?php get_assets("newsletter") ; ?>
        <?php get_assets("logo-carousel") ; ?>
        <?php get_assets("footer") ; ?>
        <?php get_assets("subfooter") ; ?>
       
        

</html>