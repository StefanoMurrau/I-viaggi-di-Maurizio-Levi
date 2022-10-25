<?php
 
    
?>

    <!-- HERO START //-->
    <section id="destinations-hero" class="page-hero">
        <div class="container-fluid">
            <div class="row g-0">
                <div id="hero-img" class="col-12" style="background-image: url(<?php echo 'img/search-banner.jpg' ; ?>);">
                    <div class="text-box">
                        <h5 class="payoff"></h5>
                        <h1 class="title">Risultati per la ricerca: <?php echo filter_var($_POST["value"], FILTER_SANITIZE_STRING).trim() ; ?></h1>
                    </div>
                    <div class="location" style="top: 85%; position: absolute; bottom: 0; left: 5rem; right: 0; width: 100%; height: 100%; color: white;">
                    </div>
                </div>
             </div>
        </div>
     </section>
    <!-- HERO END //-->
