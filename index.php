<?php 

    require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "settings.php" ) ;
    require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "functions.php" ) ;
    require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "dbconn.php" ) ;

?>


<!DOCTYPE html>

<html lang="it">

    <?php get_assets($asset = "header", "Pagina iniziale") ; ?>

    
    <body>
    
        <?php get_assets("navbar") ; ?>
        <?php get_assets("hero", "", "homepage" . DIRECTORY_SEPARATOR . "homepage") ; ?>
        <?php get_assets("mission", "", "homepage" . DIRECTORY_SEPARATOR . "homepage") ; ?>
        <?php get_assets("travels-carousels", "", "homepage" . DIRECTORY_SEPARATOR . "homepage", $conn) ; ?>
        <?php get_assets("destinations", "", "homepage" . DIRECTORY_SEPARATOR . "homepage", $conn) ; ?>
        <?php get_assets("travel-lines", "", "homepage" . DIRECTORY_SEPARATOR . "homepage", $conn) ; ?>
        <?php get_assets("blog", "", "homepage" . DIRECTORY_SEPARATOR . "homepage") ; ?>
        <?php get_assets("additional-info") ; ?>
        <?php get_assets("newsletter") ; ?>
        <?php get_assets("logo-carousel") ; ?>
        <?php get_assets("footer") ; ?>
        <?php get_assets("subfooter") ; ?>
       
        

</html>