<?php

    
    $cod_linea_viaggio = $_GET['id'] ;
    
    try 
        {
        $a = mc_get_img_business_object('LEVI', $cod_linea_viaggio , 'BANNER-LINEEVIAGGIO', 'LINEAVIAGGIO', $conn);

        $immagine_copertina = "/img/levi-logo.svg";
    
        if($a['url_foto'])
            {
            $immagine_copertina = $a['url_foto'];
            }

        if($a['descrizione'])
            {
            $descrizione_foto = $a['descrizione'];
            } 
        } 
    catch(Exception $e) 
        {
        $e->getMessage();
        $immagine_copertina = "/img/levi-logo.svg" ;
        } 

        $data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "travel-lines-hero/". (string)$cod_linea_viaggio, "levi") ;
?>

        <!-- HERO START //-->
        <section id="travel-lines-hero" class="page-hero">
            <div class="container-fluid">
                <div class="row g-0">
                    <div id="hero-img" class="col-12" style='background-image:url(<?php echo $immagine_copertina ; ?>) ;'>          
                        <div class="text-box">
                            <h5 class="payoff"><?php echo $data["hero"][0]['payoff'] ; ?></h5>
                            <h1 class="title"><?php echo $data["hero"][0]['title'] ; ?></h1>
                            <!-- <p class="image-description mt-5"><i class="fas fa-map-marker-alt"> </i> <?php echo $descrizione_foto ; ?></p> -->
                        </div>
                       
                    </div>
                </div>
            </div>
        </section>
        <!-- HERO END //-->
