<?php 

    $data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "additional-info", "levi") ; 

?>

        <!-- ADDITIONAL INFO START -->
        <?php if( array_key_exists("additional-info", $data) && !empty($data["additional-info"]) ){ ?>

        <section id="additional-info">
            <div class="container">
                <div class="row g-0 mb-5">
                    <div class="col-12 col-sm-12 mb-5 text-center mx-auto ">
                        <p class="payoff"><?php echo $data["additional-info"]['payoff']; ?></p>
                        <h2 class="title"><?php echo $data["additional-info"]['title']; ?></span></h2>
                    </div>

                    <div class="col-12 col-sm-12 col-lg-4 pt-5 pt-lg-0 text-center mx-auto order-3 order-lg-1" id="points-of-strength">
                        <ul>
                            <li class="mb-5">
                                <div class="diamond mx-auto mb-2"></div>
                                <div class="title mb-2"><?php echo $data["additional-info"]['elements'][0]['title']; ?></div>
                                <div class="content mb-2 px-5"><?php echo $data["additional-info"]['elements'][0]['text']; ?></div>
                            </li>
                            <li class="mb-5">
                                <div class="diamond mx-auto mb-2"></div>
                                <div class="title mb-2"><?php echo $data["additional-info"]['elements'][1]['title']; ?></div>
                                <div class="content mb-2 px-5"><?php echo $data["additional-info"]['elements'][1]['text']; ?></div>
                            </li>
                            <li class="mb-5">
                                <div class="diamond mx-auto mb-2"></div>
                                <div class="title mb-2"><?php echo $data["additional-info"]['elements'][2]['title']; ?></div>
                                <div class="content mb-2 px-5"><?php echo $data["additional-info"]['elements'][2]['text']; ?></div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-4 order-1 order-lg-2">
                        <div class="row align-items-center img-wrapper mb-3 mb-md-0">
                            <img src="img/<?php echo $data["additional-info"]["image1"]; ?>" class="img-fluid" alt="">
                            <img src="img/<?php echo$data["additional-info"]["image2"]; ?>" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-lg-4 ps-md-3 pt-5 pt-lg-0 order-2 order-lg-3" id="testament">
                        <div class="content ps-5">
                            <?php echo $data["additional-info"]['text']; ?> 
                        </div>
                    </div>

                </div>
            </div>
        </section>
        
        <?php } ?>

        <!-- ADDITIONAL INFO END -->
