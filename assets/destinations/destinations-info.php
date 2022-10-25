<?php


    $id = $_GET['id'] ;
    $data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "destinations-info/". (string)$id, "levi") ;
?>

    <!-- INFO CONTINENTI START -->
    <section id="info-continenti">
        <div class="container">
            <div class="row g-0 mb-5">
                <div class="col-12 col-sm-12 col-md-6 pe-md-5 order-2 order-md-1 ">
                    <div class="row align-items-center img-wrapper">
                        <img src="img/<?php echo $data['destination_info'][0]["image1"] ; ?>.jpeg" class="img-fluid" alt="">
                        <img src="img/<?php echo $data['destination_info'][0]["image2"] ; ?>.jpeg" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-5 offset-md-1 order-1 order-md-2 ps-md-1 mb-3 mb-md-0">
                    <div class="col-12 mb-3">
                        <p class="payoff"></p>
                        <h2 class="title"><?php echo $data['destination_info'][0]['label'] ; ?></h2>
                    </div>
                    <div class="content">
                        <?php echo $data['destination_info'][0]['text'] ; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- INFO CONTINENTI END -->