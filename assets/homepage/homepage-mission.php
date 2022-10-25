
<?php
    $data = mc_middleware_call(constant("MIDDLEWARE_BASE_URL"), "homepage-mission", "levi") ;
?>
        <!-- MISSION START //-->
        <?php if( array_key_exists("mission", $data) && !empty($data["mission"]) ){ ?>
        <section id="mission">
            <div class="container">
                <div class="row g-0">
                    <div class="col-12 col-sm-12 col-md-6 pe-md-5 order-2 order-md-1">
                        <div class="row align-items-center img-wrapper">
                            <img src="<?php echo $data['mission'][0]["image1"] ; ?>" class="img-fluid" alt="<?php echo $data['mission'][0]["image1"] ; ?>">
                            <img src="<?php echo $data['mission'][0]["image2"] ; ?>" class="img-fluid" alt="<?php echo $data['mission'][0]["image2"] ; ?>">                
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-5 offset-md-1 order-1 order-md-2 ps-md-1 mb-3 mb-md-0">
                        <h2 class="title text-start mb-3"><?php echo $data['mission'][0]["title"] ; ?></h2>
                        <div class="content"><?php echo $data['mission'][0]["text"] ; ?></div> 
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        <!-- MISSION END //-->
