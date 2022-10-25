<?php 
    $departing = mc_middleware_call(constant("MIDDLEWARE_BASE_URL"), "homepage-departing-travels", "levi") ;
    $inEvidence = mc_middleware_call(constant("MIDDLEWARE_BASE_URL"), "homepage-travels-in-evidence", "levi") ;

 
    if( count($departing['departing_travels'][0]['travels']) > 0 || count($inEvidence['travels_in_evidence'][0]['travels']) > 0) 
        {  
    
?> 
        <!-- TRAVELS-CAROUSELS START //-->
        <section id="travels-carousels">
            <div class="container-fluid">
                <div class="row">           
                    <div class="col-12 col-sm-12 col-md-4 mb-5 mb-sm-5 mb-md-0 order-2 order-sm-2 order-md-1">
                        <div class="owl-carousel owl-theme" id="travel-highlights">

                            <?php 

                                foreach(array_slice($inEvidence['travels_in_evidence'][0]['travels'], 0, 9) as $t)
                                    {                                                        
                                    $card_image = mc_get_img_banner_viaggi('LEVI', $t['id'], 'BANNER-VIAGGIO', $conn, constant("KEL12_IMAGE_BASE_URL")) ; 
                            
                            ?>

                            <div class="item">
                                <div class="card" style="background: url('<?php echo $card_image["url_foto"] ; ?>') ;">
                                    <div class="card-body">
                                        <h5 style="position: absolute; bottom: 60px;" class="card-payoff"><?php echo $t['length']; ?> giorni</h5>
                                        <h5 class="card-payoff"><?php echo $t['nation']; ?></h5>
                                        <h2 class="card-title"><?php echo $t['title']; ?></h2>                                
                                        <a href= "<?php echo $base_url ?>single-travel.php?id=<?php echo $t['id']; ?>">
                                            <button type="button" class="levi-secondary-btn" >Scopri il viaggio</button>
                                        </a>                                   
                                    </div>
                                </div>
                            </div>

                            <?php

                                    } 
                                               
                            ?>

                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-2 mb-5 mb-sm-5 mb-md-0 order-1 order-sm-1 order-md-2" id="text-container-sx">
                    <img style="cursor: pointer ;" src="../img/left-arrow.png" class="img-fluid d-none d-sm-none d-md-block" alt="Freccia a sinistra" onclick="$('#travel-highlights.owl-carousel').trigger('next.owl.carousel');" >
                        <h5 class="card-payoff"><?php echo $inEvidence['travels_in_evidence'][0]['payoff']; ?></h5>
                        <h2 class="card-title"><?php echo $inEvidence['travels_in_evidence'][0]['title']; ?></h2>
                        <p class="card-text"><?php echo $inEvidence['travels_in_evidence'][0]['text']; ?></p>
                    </div>

                    <div class="col-12 col-sm-12 col-md-2 mb-5 mb-sm-5 mb-md-0 order-3 order-sm-3 order-md-3" id="text-container-dx">
                        <img style="cursor: pointer ;" src="../img/right-arrow.png" class="img-fluid  d-none d-sm-none d-md-block" alt="Freccia a destra" onclick="$('#departing-trips.owl-carousel').trigger('prev.owl.carousel');">
                        <h5 class="card-payoff"><?php echo $departing['departing_travels'][0]['payoff']; ?></h5>
                        <h2 class="card-title"><?php echo $departing['departing_travels'][0]['title']; ?></h5>
                        <p class="card-text"><?php echo $departing['departing_travels'][0]['text']; ?></p>
                    </div>

                    <div class="col-12 col-sm-12 col-md-4 mb-5 mb-sm-5 mb-md-0 order-4 order-sm-4 order-md-4">
                        <div class="owl-carousel owl-theme" id="departing-trips">

                            <?php 
                            
                                foreach(array_slice($departing['departing_travels'][0]['travels'], 0, 9) as $t) 
                                    { 
                                    $card_image = mc_get_img_banner_viaggi('LEVI', $t['id'], 'BANNER-VIAGGIO', $conn, constant("KEL12_IMAGE_BASE_URL")) ;
                                                                                
                            ?>

                            <div class="item">
                                <div class="card" style="background: url('<?php echo $card_image["url_foto"] ; ?>') ;">
                                    <div class="card-body">
                                        <h5 style="position: absolute; bottom: 60px;" class="card-payoff"><?php echo $t['length']; ?> giorni</h5>
                                        <h5 class="card-payoff"><?php echo $t['nation']; ?></h5>
                                        <h2 class="card-title"><?php echo $t['title']; ?></h2>      
                                        <a href= "<?php echo $base_url ?>single-travel.php?id=<?php echo $t['id'] ; ?>">
                                            <button type="button" class="levi-secondary-btn" >Scopri il viaggio</button>
                                        </a>  
                                    </div>
                                </div>
                            </div>

                            <?php 
                        
                                    } 
                        
                            ?>

                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- TRAVELS-CAROUSELS END //-->    

<?php 

        }

?>