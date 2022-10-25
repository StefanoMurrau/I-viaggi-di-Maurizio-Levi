<?php

$data = array(
    "image" => "https://kel12image.com/uploads/europa/08-venezia-esterno-mosaici-basilica-san-marco.jpg",
    "title" => "Partenze"
    ) ;

?>

        <!-- HERO START //-->
        <section id="departures-hero" class="page-hero">
            <div class="container-fluid">
                <div class="row g-0">
                    <div id="hero-img" class="col-12" style='background-image:url("<?php echo $data['image'] ; ?>") ;'>
                        <div class="text-box">
                            <h5 class="payoff"><?php echo $data['payoff'] ; ?></h5>
                            <h1 class="title"><?php echo $data['title'] ; ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- HERO END //-->
