<?php

    $id_viaggio = $_GET['id'] ;
    $base_url = base_url() ;
    $viaggio_klsgp = mc_apicall_viaggio($id_viaggio) ;

    date_default_timezone_set('UTC') ;
    setlocale(LC_ALL, 'it_IT.UTF-8') ;
    define('DRIVER', 'mysql') ;
    define('DB_HOST', 'kel12image.com') ;
    define('DB_NAME', 'kelimage_application') ;
    define('DB_USER', 'kelimage_mare_consulting') ;
    define('DB_PASSWORD', 'MareConsulting71!') ;
    define('DB_ENCODING', 'utf8') ;
    define('DB_PORT', '3306') ;

    try 
        {
        $conn = new PDO("mysql:host=" .  constant('DB_HOST') . ";dbname=" . constant('DB_NAME') . ";user=" . constant('DB_USER') . ";password=" . constant('DB_PASSWORD') . ";options='--client_encoding=" . constant('DB_ENCODING') . "'") ;
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
        } 
    catch(PDOException $e) 
        {
        echo "CONNESSIONE FALLITA: " . $e->getMessage() ;
        }

    try 
        {
        $a = mc_get_img_gallery ('LEVI', $id_viaggio , 'viaggio' , $conn) ;
    
        for($i = 0; $i <= 18; $i++) 
            {
            $foto[$i] = $a[$i]['url_foto'] ;
            }
        } 
    catch(Exception $e) 
        {
        //echo $e->getMessage() ;
        }

?>     
       
       <!-- GALLERY START //-->
       <style>
* {
  box-sizing: border-box;
}


.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  padding: 0 4px;
}

/* Create four equal columns that sits next to each other */
.column {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
  max-width: 33%;
  padding: 0 4px;
}

.column img {
  margin-top: 8px;
  vertical-align: middle;
  width: 100%;
}

/* Responsive layout - makes a two column-layout instead of four columns */
@media screen and (max-width: 800px) {
  .column {
    -ms-flex: 50%;
    flex: 50%;
    max-width: 50%;
  }
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column {
    -ms-flex: 100%;
    flex: 100%;
    max-width: 100%;
  }
}
</style>


        
            <div class="container">
                <div class="row g-0">
                    <div class="row"  >
                        <div class="column" id="gallery-container">
                            <a class="col-4" data-lg-size="" data-src="<?php echo $foto[0]; ?>" data-responsive="" data-sub-html="">
                                <img src="<?php echo $foto[0]; ?>">
                            </a>

                            <a class="col-4" data-lg-size="" data-src="<?php echo $foto[1]; ?>" data-responsive="" data-sub-html="">
                                <img src="<?php echo $foto[1]; ?>">  
                            </a>

                            <a class="col-4" data-lg-size="" data-src="<?php echo $foto[2]; ?>" data-responsive="" data-sub-html="">
                                <img src="<?php echo $foto[2]; ?>">
                            </a>

                            <a class="col-4" data-lg-size="" data-src="<?php echo $foto[9]; ?>" data-responsive="" data-sub-html="">
                                <img src="<?php echo $foto[9]; ?>">   
                            </a>  
                            
                            <a class="col-4" data-lg-size="" data-src="<?php echo $foto[13]; ?>" data-responsive="" data-sub-html="">
                                <img src="<?php echo $foto[13]; ?>">  
                            </a>                    
                        </div>
                        <div class="column" id="gallery-container-bis">
                            <a class="col-4" data-lg-size="" data-src="<?php echo $foto[3]; ?>" data-responsive="" data-sub-html="">
                                <img src="<?php echo $foto[3]; ?>">
                                </a>
                            <a class="col-4" data-lg-size="" data-src="<?php echo $foto[4]; ?>" data-responsive="" data-sub-html="">
                                <img src="<?php echo $foto[4]; ?>">
               
                            </a>
                            <a class="col-4" data-lg-size="" data-src="<?php echo $foto[5]; ?>" data-responsive="" data-sub-html="">
                            <img src="<?php echo $foto[5]; ?>"> 

                            </a>
                            <a class="col-4" data-lg-size="" data-src="<?php echo $foto[10]; ?>" data-responsive="" data-sub-html="">
                            <img src="<?php echo $foto[10]; ?>">  
                            </a>
                            <a class="col-4" data-lg-size="" data-src="<?php echo $foto[14]; ?>" data-responsive="" data-sub-html="">
                          
                            <img src="<?php echo $foto[14]; ?>">
                            </a>
                            <a class="col-4" data-lg-size="" data-src="<?php echo $foto[15]; ?>" data-responsive="" data-sub-html="">
                            <img src="<?php echo $foto[15]; ?>"> 
                            </a>
                            <a class="col-4" data-lg-size="" data-src="<?php echo $foto[16]; ?>" data-responsive="" data-sub-html="">
                            <img src="<?php echo $foto[16]; ?>">  
                            </a>

                   
                        </div>

                        <div class="column" id="gallery-container-tris">

                            <a class="col-4" data-lg-size="" data-src="<?php echo $foto[6]; ?>" data-responsive="" data-sub-html="">
                                <img src="<?php echo $foto[6]; ?>">  
                            </a>

                            <a class="col-4" data-lg-size="" data-src="<?php echo $foto[7]; ?>" data-responsive="" data-sub-html="">
                                <img src="<?php echo $foto[7]; ?>">  
                            </a>    

                            <a class="col-4" data-lg-size="" data-src="<?php echo $foto[8]; ?>" data-responsive="" data-sub-html="">
                                <img src="<?php echo $foto[8]; ?>"> 
                            </a>

                            <a class="col-4" data-lg-size="" data-src="<?php echo $foto[11]; ?>" data-responsive="" data-sub-html="">
                                <img src="<?php echo $foto[11]; ?>"> 
                            </a>

                            <a class="col-4" data-lg-size="" data-src="<?php echo $foto[12]; ?>" data-responsive="" data-sub-html="">
                                <img src="<?php echo $foto[12]; ?>">
                            </a>

                            <a class="col-4" data-lg-size="" data-src="<?php echo $foto[17]; ?>" data-responsive="" data-sub-html="">
                                <img src="<?php echo $foto[17]; ?>"> 
                            </a>

                            <a class="col-4" data-lg-size="" data-src="<?php echo $foto[18]; ?>" data-responsive="" data-sub-html="">
                                <img src="<?php echo $foto[18]; ?>">  
                            </a>

                        </div>
                    </div>
                </div>
            </div>
            <div style="min-height: 20px;"></div>
        <!-- GALLERY END //-->