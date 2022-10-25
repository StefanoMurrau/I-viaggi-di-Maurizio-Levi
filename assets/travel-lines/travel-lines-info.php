<?php
    $cod_linea_viaggio = $_GET['id'] ;
    $data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "travel-line-info/". (string)$cod_linea_viaggio, "levi") ;

    ?>

    <!-- travel line info START -->
    <?php if( array_key_exists("travel-line-info", $data) && !empty($data["travel-line-info"]) ){ ?>
    <section id="travel-line-info">
        <div class="container">
            <div class="row g-0 mb-5">
                <div class="col-12 col-sm-12 col-md-6 pe-md-5 order-2 order-md-1 ">
                    <div class="row align-items-center img-wrapper">
                        <img src="/img/<?php echo $data["travel-line-info"][0]['image1'] ; ?>" class="img-fluid" alt="<?php echo $data["travel-line-info"][0]['image1'] ; ?>">
                        <img src="/img/<?php echo $data["travel-line-info"][0]['image2'] ; ?>" class="img-fluid" alt="<?php echo $data["travel-line-info"][0]['image2'] ; ?>">
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-5 offset-md-1 order-1 order-md-2 ps-md-1 mb-3 mb-md-0">
                    <div class="col-12 mb-3">
                        <p class="payoff"><?php echo $data["travel-line-info"][0]['payoff']; ?></p>
                        <h2  class="title" style="font-size: 40px !important;"><?php echo $data["travel-line-info"][0]['title'];  ?></h2>
                    </div>
                    <div class="content">
                        <?php echo $data["travel-line-info"][0]['content']; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <!-- travel-line-info END -->

