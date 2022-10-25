<?php

    // $data = array(
    //     "title" => "Esperti di viaggio",
    //     "content" => "Un team di professionisti animato dalla passione per i viaggi e dall’entusiasmo di condividere la esperienza e conoscenze con i viaggiatori: <br><br><b>esperti</b>, spesso specialisti (es. archeologi, antropologi, geologi, etc.) che <b>rendono il viaggio un’esperienza unica e intensa</b>, <br><br>in grado di arricchire l'esplorazione di luoghi storici e insoliti, l'incontro con i popoli e le loro tradizioni.</p>",
    //     "images" => array([
    //         "img/esperti_di_viaggio_1.jpg",  
    //         "img/esperti_di_viaggio_2.jpg"
    //         ])
    //     );

        

    // $base_url = get_base_url() ;
    $data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "tour-leaders-mission", "levi") ;
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
                        <div class="col-12 mb-3">
                            <h2 class="title text-start"><?php echo $data['mission'][0]["title"] ; ?></h2>
                        </div>
                        <div class="content"><?php echo $data['mission'][0]["text"] ; ?></div> 

                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        <!-- MISSION END //-->
