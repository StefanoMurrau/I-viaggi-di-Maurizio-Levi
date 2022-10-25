        
<?php
    
// $base_url = get_base_url();
// $id_tl = $_GET['id'] ;

// $arr_tl = mc_apicall_viaggio_tl($id_tl );

$data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "tour-leaders-single/".$_GET['id'], "levi") ;
?>
        
        <!-- MISSION START //-->
        <section id="mission">
            <div class="container">
                <div class="row g-0">
                    <div class="col-12 col-sm-12 col-md-6 pe-md-5 order-2 order-md-1">
                        <div class="row align-items-center ">
                            <img src="<?php echo $data["tour_leader_single"][0]["image"] ;?>" class="img-fluid" alt="<?php echo $data["tour_leader_single"][0]["firstname_tour_leader"] ;?><br><?php echo $data["tour_leader_single"][0]["lastname_tour_leader"] ;?>">                     
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-5 offset-md-1 order-1 order-md-2 ps-md-1 mb-3 mb-md-0">
                        <div class="col-12 mb-3">
                            <h2 class="title"><?php echo  $data["tour_leader_single"][0]["firstname_tour_leader"] ; ?><br><?php echo $data["tour_leader_single"][0]["lastname_tour_leader"] ; ?></h2>
                        </div>
                        <div class="content"><?php echo $data["tour_leader_single"][0]["cv"] ;?></div> 

                    </div>
                </div>
            </div>
        </section>
        <!-- MISSION END //-->
