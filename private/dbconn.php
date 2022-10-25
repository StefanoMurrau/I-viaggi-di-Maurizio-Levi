<?php

    require_once( __DIR__ . DIRECTORY_SEPARATOR . "settings.php" ) ;
    require_once( __DIR__ . DIRECTORY_SEPARATOR . "functions.php" ) ;

    try
        {
        $conn = new PDO("mysql:host=" .  constant('DB_HOST') . ";dbname=" . constant('DB_NAME') . ";user=" . constant('DB_USER') . ";password=" . constant('DB_PASSWORD') . ";options='--client_encoding=" . constant('DB_ENCODING') . "'") ;
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;   
        }
    catch(PDOException $e) 
        {
        $e->getMessage() ;
        log_manager("errors.log", "ALERT", $e) ;
        }

?>