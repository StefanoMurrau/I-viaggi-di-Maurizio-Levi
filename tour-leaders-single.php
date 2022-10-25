<?php 

    require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "settings.php" ) ;
    require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "functions.php" ) ;
    require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "dbconn.php" ) ;

?>

<!DOCTYPE html>

<html lang="it">

    <?php get_assets($asset = "header", "Tour Leader") ; ?>
    
    <body>
    
        <?php get_assets("navbar") ; ?>
        <?php get_assets("hero", "","tour-leaders-single" . DIRECTORY_SEPARATOR . "tour-leaders-single", null) ; ?>
        <?php get_assets("mission", "", "tour-leaders-single" . DIRECTORY_SEPARATOR . "tour-leaders-single", null) ; ?>
        <?php get_assets("partenze", "", "tour-leaders-single" . DIRECTORY_SEPARATOR . "tour-leaders-single", $conn) ; ?>
        <?php get_assets("additional-info") ; ?>
        <?php get_assets("newsletter") ; ?>
        <?php get_assets("logo-carousel") ; ?>
        <?php get_assets("footer") ; ?>
        <?php get_assets("subfooter") ; ?>
       

        
</html>