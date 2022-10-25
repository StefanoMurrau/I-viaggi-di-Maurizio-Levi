<?php

    $id_viaggio = $_GET['id'] ;
    $base_url = base_url() ;
    
    $data = mc_apicall_viaggio($id_viaggio) ;

?> 

    <!-- CTA START //-->
    <section id="cta" class="cta">
        <div class="container">
            <div class="row g-0">
                <div class="col-9 col-sm-9 text-start">
                    <h2 class="title" style="text-align:left;"><?php echo $data['response'][0]['titoloViaggio']; ?></h2>
                    <p>A partire da <?php echo $data['response'][0]['prezzo']; ?> &euro;</p>
                </div>
                <div class="col-3 col-sm-3 text-end align-self-center">
                    <button type="submit" class="levi-secondary-btn" data-bs-toggle="modal" data-bs-target="#mc_cta_modal">Richiedi Maggiori Informazioni</button>
                </div>
            </div>
        </div>
    </section>
    <!-- CTA END //-->