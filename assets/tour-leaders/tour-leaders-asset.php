        
        
<?php

    
$base_url = get_base_url();
$id_tl = $_GET['id'] ;

$arr_tl = mc_apicall_viaggio_tl($id_tl );

?>
        
        
        <!-- MISSION START //-->
        <section id="mission">
            <div class="container">
                <div class="row g-0">
                    <div class="col-12 col-sm-12 col-md-6 pe-md-5 order-2 order-md-1">
                        <div class="row align-items-center img-wrapper">
                            <img src="<?php echo $arr_tl['response'][0] ; ?>" class="img-fluid" alt="Levi mission 1">                     
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-5 offset-md-1 order-1 order-md-2 ps-md-1 mb-3 mb-md-0">
                        <div class="col-12 mb-3">
                            <h2 class="title text-start"><?php echo $arr_tl['response'][0]['nomeTourLeader'];?><br><?php echo $arr_tl['response'][0]['cognomeTourLeader'];?></h2>
                        </div>
                        <div class="content"><?php echo $arr_tl['response'][0]['cv'];?></div> 

                    </div>
                </div>
            </div>
        </section>
        <!-- MISSION END //-->
