<?php

    // $base_url = get_base_url();
   
    // function get_tour_leaders_list()
    //     {
    //     $URL = "https://klsgp.kel12.it" ;
    //     $ENDPOINT = "/api/Anagrafiche/TourLeader" ;

    //     $textToEncrypt = strftime("%Y%m%d%H%M%S") ;
    //     $encryptionMethod = "AES-256-CBC" ;
    //     $secretHash = "Kel12VLB2022" ;

    //     $token = openssl_encrypt($textToEncrypt, $encryptionMethod, $secretHash) ;

    //     $postRequest = array(
    //         "flPubblicare" => true,
    //         "token" => $token
    //     ) ;

    //     $curl = curl_init() ;
    //     curl_setopt($curl, CURLOPT_URL, $URL . $ENDPOINT) ;
    //     curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($postRequest)) ;
    //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1) ;
    //     curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    //         'Content-Type:application/json',
    //         'Content-length: ' . strlen( json_encode($postRequest) )
    //     )) ;

    //     $response = curl_exec($curl) ;
    //     $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE) ;

    //     curl_close($curl) ;

    //     return array( 'httpcode' => $httpcode, "response" => json_decode($response, true)) ;
    //     }

    // $tour_leaders = get_tour_leaders_list()['response'] ;
	// foreach( $tour_leaders as $k=>$prio )
	// 	{
		
    //     $priority[$k] = $prio['priorita'] ;
	// 	}
        

    
    // array_multisort($priority,SORT_ASC,SORT_NUMERIC, $tour_leaders ) ;

    $data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "tour-leaders-list", "levi") ;
?>

    <!-- TOUR-LEADERS-LIST START //-->
    <?php if( array_key_exists("tour_leader_list", $data) && !empty($data["tour_leader_list"]) ){?>
    <section id="tour-leaders-list">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <div class="col">
                    <div class="card">
                        <div class="card-img"></div>
                        <div class="card-img-overlay">
                            <p class="payoff mb-2"><?php echo $data["tour_leader_list"][0]['payoff'] ; ?></p>
                            <h2 class="card-title mb-4"><?php echo $data["tour_leader_list"][0]['title'] ; ?></h2>
                            <p class="card-text"><?php echo $data["tour_leader_list"][0]['text'] ; ?></p>
                        </div>
                    </div>
                </div>
                
                <?php 
                    $ii= 0;

                    foreach( $data["tour_leader_list"][0]['tour_leaders'] as $tour_leader )
                        {
                        $immagine_copertina = "img/levi-logo.svg" ;
                        
                        if(strlen($tour_leader["image"])>0) 
                            {
                            $immagine_copertina = $tour_leader["image"];
                            }
                ?>

                    <div class="col p-0 m-0">
                        <div class="tlclass">
                            <div class="card m-3" style="background-image: url('<?php echo $immagine_copertina ?>') ;">
                                <div class="card-img-overlay h-100">
                                    <p style="text-transform: uppercase;font-weight: 300;font-size: calc(0.6rem + 0.4vw);color: white;"><?php echo $tour_leader["typology"] ; ?></p>
                                    <h5 class="card-title" style="color: #fff;font-weight: 500;font-size: calc(1.2rem + 0.3vw);text-transform: uppercase;margin-bottom: 20px"><?php echo $tour_leader["firstname_tour_leader"] ; ?><br/><?php echo $tour_leader["lastname_tour_leader"] ; ?></h5>
                                    <a href="tour-leaders-single.php?id=<?php echo $tour_leader["id_kel_tour_leader"] ; ?>">
                                        <button class="levi-secondary-btn">Scopri di più</button>
                                    </a>
                                </div>
                            </div>
                        </div> 
                    </div>

                <?php 

                        $ii= $ii + 1;

                        } 
                    if(!$ii) 
                        { 
                        echo "Siamo spiacenti non sono presenti tour leader." ;
                        }

                ?>

            </div>
            <!-- <div class="text-center">
                <button class="col levi-primary-btn" id="load-tourleaders" style=" text-align: center;">Load More</button>
            </div> -->
        </div>
    </section>
    <?php } ?>
    <!-- TOUR-LEADERS-LIST END //-->