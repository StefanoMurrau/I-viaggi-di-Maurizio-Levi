<?php
    $nation_id= $_GET["id"];
    
    try 
        {   
        $immagine_copertina = mc_get_img_nazione ('LEVI', $nation_id, 'BANNER-NAZIONI', $conn) ; 
        } 
    catch(Exception $e) 
        {
        echo $e->getMessage();
        }

        $data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "nations-hero/".(string)$nation_id, "levi") ;

?>

    <!-- HERO START //-->
    <section id="destinations-hero" class="page-hero">
        <div class="container-fluid">
            <div class="row g-0">
                <div id="hero-img" class="col-12" style="background-image: url(<?php echo $immagine_copertina["url_foto"]; ?>);">
                    <div class="text-box">
                        <h5 class="payoff"><?php echo $data["hero"][0]["payoff"] ; ?></h5>
                        <h1 class="title"><?php echo $data["hero"][0]["title"] ; ?></h1>
                    </div>
                    <div class="location" style="top: 85%; position: absolute; bottom: 0; left: 5rem; right: 0; width: 100%; height: 100%; color: white;">
                        <p class="image-description mt-5"><i class="fas fa-map-marker-alt"> </i> <?php echo $descrizione_foto["descrizione"]; ?></p>
                    </div>
                </div>
             </div>
        </div>
     </section>
    <!-- HERO END //-->
