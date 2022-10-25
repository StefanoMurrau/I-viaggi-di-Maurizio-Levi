<?php

// $data = array(
//     "image" => "https://kel12image.com/uploads/europa/08-venezia-esterno-mosaici-basilica-san-marco.jpg",
//     "title" => "Chi siamo"
//     ) ;
    $data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "about-us-hero", "levi") ;
?>
        <!-- HERO START //-->
        <section id="about-us-hero" class="page-hero">
            <div class="container-fluid">
                <div class="row g-0">
                    <div id="hero-img" class="col-12" style='background-image:url("<?php echo $data["hero"][0]['image'] ; ?>") ;'>
                        <div class="text-box">
                            <h5 class="payoff"><?php echo $data["hero"][0]['payoff'] ; ?></h5>
                            <h1 class="title"><?php echo $data["hero"][0]['title'] ; ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- HERO END //-->
