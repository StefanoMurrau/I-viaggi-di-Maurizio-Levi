<?php
    $data = mc_middleware_call(constant("MIDDLEWARE_BASE_URL"), "homepage-travel-lines", "levi") ;
?>

        <!-- TRAVEL LINES START //-->
   <?php if( array_key_exists("travel_lines", $data) && !empty($data["travel_lines"]) ){ ?>
        <section id="travel-lines">
            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-img"></div>
                            <div class="card-img-overlay">
                                <p class="payoff mb-2"><?php echo $data["travel_lines"][0]['payoff'] ?></p>
                                <h2 class="card-title mb-4"><?php echo $data["travel_lines"][0]['title'] ?></span></h2>
                                <p class="card-text"><?php echo $data["travel_lines"][0]['text'] ?></p>
                            </div>
                        </div>
                    </div>

                    <?php foreach($data["travel_lines"][0]["lines"] as $e) { ?>

                        <?php 
                            $img_data = mc_get_img_business_object ('LEVI', $e['id'] , 'CARD-LINEEVIAGGIO', 'LINEAVIAGGIO', $conn) ; 
                            $url = $img_data["url_foto"] ;
                            
                        ?>
        
                        <div class="col">
                            <div class="card" style="background-image: url('<?php echo $url ; ?>') ;">
                                <div class="card-img-overlay h-100"> 
                                    <h5 class="card-title"><?php echo $e["title"] ; ?></h5>
                                    <a href="<?php echo "travel-lines.php?id=" . $e["id"] ; ?>">
                                        <button class="levi-secondary-btn">Scopri di più</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                           
                    <?php } ?>

                </div>
            </div>
        </section>
        <?php } ?>
        <!--  END //-->