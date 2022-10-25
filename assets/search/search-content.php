<?php



    $payload = array(

        "flPubblicareLevi"=> true,

        "token" => create_api_token()

        ) ;



    $travels = mc_apicall(constant("API_BASE_URL"), "/api/Viaggi/Viaggi", $payload) ;

    $value = filter_var($_POST["value"], FILTER_SANITIZE_STRING) ;



    $search_elemets = array(

        "titoloViaggio",

        "beneAsapersi",

        "areaGeografica",

        "nazione",

        "paroleChiave",

        "puntiDiForza",

        "testoPerSito",

        "comprendeNonComprende",

        "comeSiViaggia"

        ) ;



    $result = array() ;



    foreach($travels as $travel)

        {

        foreach($search_elemets as $e)

            {

            $string_to_test = strtolower( strip_tags($travel[$e]) ).trim() ;



            $pos = stripos($string_to_test, strtolower($value).trim() );

            if($pos !== false) 

                {

                array_push($result, $travel ) ;

                break ;

                }

            }    

        }



    if(count($result) == 0)

        {

        echo "NESSUN DATO TROVATO" ;

        }

    else

        {



        $base_url = get_base_url();



            ?>

        

                <!-- CONTENT START //-->

                <section id="search-content">

                    <div class="container">

                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

                           

                            <?php foreach($result as $e) { ?>

        

                                <?php 

                                    

                                    $img_data = mc_get_img_banner_viaggi('LEVI', $e['idViaggioKel'], 'BANNER-VIAGGIO', $conn, constant("KEL12_IMAGE_BASE_URL")) ; 

                                    $url = $img_data["url_foto"] ;

                                    

                                ?>

                

                                <div class="col">

                                    <div class="card" style="background-image: url('<?php echo $url ; ?>') ;">

                                        <div class="card-img-overlay h-100"> 

                                            <h5 class="card-title"><?php echo $e["titoloViaggio"] ; ?></h5>

                                            <a href="<?php echo $base_url; ?>/single-travel.php?id=<?php echo $e['idViaggioKel']; ?>">

                                                <button class="levi-secondary-btn">Scopri di più</button>

                                            </a>

                                        </div>

                                    </div>

                                </div>

                                   

                            <?php } ?>

        

                        </div>

                    </div>

                </section>

                <!-- CONTENT END //-->



            <?php

        }



?>