<?php

    // $data = array(
    //     "title" => "I nostri Tour Leaders",
    //     "image" => "https://kel12image.com/uploads/europa/banner-mantova-e-cremona.jpg"
    //     );




    //$image_banner = get_image_url(get_base_url(), "/img/", $data[0]["image"]);
    $data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "tour-leaders-hero", "levi") ;
?>
  
    <!-- HERO START //-->
    <section id="tour-leaders-hero" class="page-hero">
        <div class="container-fluid">
            <div class="row g-0">
                <div id="hero-img" class="col-12" style="background-image: url(<?php echo $data["hero"][0]["image"] ; ?>);">
                    <div class="text-box">
                        <h5 class="payoff"><?php echo  $data["hero"][0]["payoff"] ; ?></h5>
                        <h1 class="title"><?php echo $data["hero"][0]["title"] ; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- HERO END //-->
    