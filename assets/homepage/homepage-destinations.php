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
/*
    $payload = array(
        "token" => create_api_token()
        ) ;
    
    $areegeo = mc_apicall(constant("API_BASE_URL"), "/api/Anagrafiche/AreeGeografiche", $payload) ;
*/
    $data = mc_middleware_call(constant("MIDDLEWARE_BASE_URL"), "homepage-destinations", "levi") ;
	
?>

        <!-- DESTINAZIONI START //-->
        <?php if( array_key_exists("destinations", $data) && !empty($data["destinations"]) ){ ?>
        <section id="destinations">
            <div class="container-fluid">

                <div id="carousel-slides" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <?php 

                            $k = 1 ;

                            foreach($data["destinations"] as $desination) 
                                {                        
                                $card_image = mc_get_img_areageo ('LEVI', $desination['id'] , 'BANNER-AREAGEOGRAFICA', $conn) ;
                                $description = $desination['title'] ;                                                
                               
                        ?>

                        <div class="carousel-item <?php echo ($k == 1) ? 'active' : "" ?>">
                            <div class="img-sub d-block w-100" style="background-image:url('<?php echo $card_image["url_foto"] ; ?>') ;">
                                <!--<img src="<?php echo $card_image["url_foto"] ; ?>" class="d-block w-100" alt="<?php echo ucfirst(strtolower($description)); ?>">//-->
                                <div class="carousel-caption">
                                    <img src="<?php echo $destinations_overlay[$desination["id"]]; ?>" alt="map" />
                                    <p class="payoff" style="color:white !important ;"><?php echo $desination['payoff']; ?></p>
                                    <h2 class="title"><?php echo $desination['title']; ?></h2>
                                    <a href="destinations.php?id=<?php echo $desination['id']; ?>">
                                        <button type="submit" class="levi-secondary-btn mb-4">Scopri le destinazioni</button>
                                    </a>
                                    <p class="image-description mt-5"><i class="fas fa-map-marker-alt"> </i> <?php echo $description; ?></p>
                                </div>
                            </div>
                        </div>

                        <?php 

                                $k++ ;
                                } 

                        ?>     

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-slides" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-slides" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>
        </section>
        <?php } ?>
        <!-- DESTINAZIONI END //-->