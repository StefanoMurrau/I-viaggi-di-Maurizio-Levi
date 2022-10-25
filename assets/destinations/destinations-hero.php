<?php
    $destinations_overlay = [
        '1' => '../img/Africa.png',
        '2' => '../img/Asia.png',
        '3' => '../img/Americhe.png',
        '5' => '../img/Oceania.png',
        '6' => '../img/Europa.png', 
        '7' => '../img/MedioOriente.png',
        '8' => '../img/Artico-e-antartico.png'
    ];
    $id_area_geo = $_GET['id'] ;

    //// Image from k12image
    $immagine_copertina = $base_url."/img/levi-logo.svg" ;
    $descrizione = "&nbsp;";
    try {
        
        $a = mc_get_img_areageo ('LEVI', $id_area_geo , 'BANNER-AREAGEOGRAFICA', $conn);

        if(strlen($a['url_foto']) >= 0 ){
            $immagine_copertina = $a['url_foto']; 
            
        } 
        $descrizione_foto = $a['descrizione'];
        

        } catch (Exception $e) {
            // an error occurred
            //echo $e->getMessage();
            
        }
    $data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "destinations-hero/".$id_area_geo, "levi") ;
?>

        <!-- HERO START //-->
        <section id="destinations-hero" class="page-hero">
            <div class="container-fluid">
                <div class="row g-0">
                    <div id="hero-img" class="col-12" style="background-image: url(<?php echo $immagine_copertina; ?>);">
                        <div class="text-box">
                            <div class="overlay pb-3">
                                <img style="display:none;" src="<?php echo $destinations_overlay[$id_area_geo]; ?>" alt="map" />
                            </div>
                            <h5 class="payoff"><?php echo $data["hero"][0]['payoff']; ?></h5>
                            <h1 class="title"><?php echo $data["hero"][0]['title']; ?></h1>
                        </div>

                        <div class="location" style="top: 85%; position: absolute; bottom: 0; left: 5rem; right: 0; width: 100%; height: 100%; color: white;">
                            <p class="image-description mt-5"><i class="fas fa-map-marker-alt"> </i> <?php echo $descrizione_foto; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- HERO END //-->

         