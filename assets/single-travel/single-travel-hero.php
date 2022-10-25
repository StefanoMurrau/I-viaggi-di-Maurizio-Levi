<?php
        
    $id_viaggio = $_GET['id'];
    $base_url = base_url();

    $data = mc_apicall_viaggio($id_viaggio) ;

    try 
        {
        $a = mc_get_img_banner_viaggi('LEVI', $id_viaggio, 'BANNER-VIAGGIO', $conn, constant("KEL12_IMAGE_BASE_URL")) ; 
        $immagine_banner = $a['url_foto'];
        }
    catch(Exception $e) 
        {
        echo $e->getMessage();
        }
       
?>
        
    <!-- HERO START //-->
    <section id="single-travel-hero" class="page-hero">
        <div class="container-fluid">
            <div class="row g-0">
                <div id="hero-img" class="col-12" style='background-image:url(<?php echo $immagine_banner ; ?>) ;'>
                    <div class="text-box">
                        <h5 class="payoff"></h5>
                        <h1 style="max-width:65%; margin: auto;" class="title"><?php echo $data["response"][0]["titoloViaggio"] ; ?></h1>
                    </div>
                    <div class="location" style="top: 85%; position: absolute; bottom: 0; left: 5rem; right: 0; width: 100%; height: 100%; color: white; pointer-events: none;">
                        <p class="image-description mt-5"><i class="fas fa-map-marker-alt"></i><?php echo $a["descrizione"] ; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- HERO END //-->
    
