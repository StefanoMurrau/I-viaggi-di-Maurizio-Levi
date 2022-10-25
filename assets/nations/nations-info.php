<?php 
    $id = $_GET['id'] ;
    
    $view = 0;

    $data_nations_description = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "nations-description/". (string)$id, "levi") ;
    $data_nations_info = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "nations-info/". (string)$id, "levi") ;

    if($view){ 
?>

    <!-- INFO START -->
    
    <section id="info-nazioni">
        <div class="container">
            <?php if( array_key_exists("nations_description", $data_nations_description) && !empty($data_nations_description["nations_description"]) ){ ?>

            <div class="row g-0 mb-5">
                <div class="col-12 col-sm-12 col-md-10 offset-md-1 mb-3">
                    <p class="payoff"><?php echo $data_nations_description["nations_description"][0]['subtitle'] ; ?></p>
                    <h2 class="title"><?php echo $data_nations_description["nations_description"][0]['title'] ; ?></h2>
                </div>
                <div class="col-12 col-sm-12 col-md-6 offset-md-1 pe-md-3 ">
                    <div class="excerpt mb-md-3">
                        <p><?php echo $data_nations_description["nations_description"][0]['text'] ;  ?></p>
                    </div>
                    <div class="row align-items-center img-wrapper mb-3 mb-md-0">

                        <img src="img/<?php echo $data_nations_description["nations_description"][0]['image1'] ; ?>" class="img-fluid" alt="<?php echo $data_nations_description["nations_description"][0]['image1'] ; ?>">
                        <img src="img/<?php echo $data_nations_description["nations_description"][0]['image2'] ; ?>" class="img-fluid" alt="<?php echo $data_nations_description["nations_description"][0]['image2'] ; ?>">

                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 ps-md-3 pt-4 pt-md-0">
                    <div class="content">
                        <?php //echo $description['text']; ?>
                    </div>
                </div>
            </div>
            
            <?php } ?>
            <?php if( array_key_exists("nations_info", $data_nations_info) && !empty($data_nations_info["nations_info"]) ){ ?>
            <div class="row g-0 mb-5">
                <div class="col-12 col-sm-12 col-md-10 offset-md-1 mb-3 pt-0 pt-lg-4">
                    <h2 class="title">Informazioni utili</h2>
                    <table class="table table-borderless">
                        <thead>
                            <tr>

                            <?php foreach($data_nations_info["nations_info"] as $info) { ?>
                                <th scope="col"><?php echo $info['title']; ?></th>
                            <?php } ?>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                            <?php

                                foreach($data_nations_info["nations_info"]  as $info)
                                    {

                            ?>
                        
                                    <td><?php echo $info['text']; ?></td>
                                
                            <?php

                                    }

                            ?>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php 

                }

            ?>

        </div>
    </section>
    <!-- INFO END -->
    <?php

}

?>