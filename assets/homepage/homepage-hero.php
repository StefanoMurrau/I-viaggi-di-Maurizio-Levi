<?php

    $data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "homepage-hero", "levi") ;

?>

        <!-- HERO START //-->
        <section id="homepage-hero">
            <div class="container-fluid">
                <div class="row g-0">
                    <div id="hero-img" class="col-12" style='background-image:url(<?php echo $data["hero"][0]["image"] ; ?>) ;'>
                        <div class="text-box">
                            <h5 class="payoff"><?php echo $data["hero"][0]["payoff"] ; ?></h5>
                            <h1 class="title"><?php echo $data["hero"][0]["title"] ; ?></h1>
                        </div>
                        <div class="pagedown">
                            <a href="#mission"><img src="../img/mouse-wheel.svg" alt="Scendi alla sessione Mission"></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- HERO END //-->
        