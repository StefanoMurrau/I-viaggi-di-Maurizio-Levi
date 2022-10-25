<?php 

    $data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "navbar", "levi") ; 
    $base_url = base_url() ;

   
   
?>

        <!-- NAVBAR START //-->
        <nav class="navbar sticky-top navbar-expand-lg mx-auto">
            <div class="navbar-inner container">
                <div class="logo">
                    <a class="navbar-brand" href="index.php">
                        <img class="img-fluid" src="../img/levi-logo.svg" alt="I Viaggi di Maurizio Levi">
                    </a>
                </div>
                <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100">

                        <?php foreach($data['navbar'] as $e) { ?>  
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo $base_url . $e["href"] ; ?>"><?php echo $e["label"] ; ?></a>
                                </li>
                        <?php } ?>

                        <li class="nav-item align-self-center">
                            <i id="search" class="nav-link fas fa-search"></i>
                        </li>
                      
                    </ul>
                </div>
            </div>
        </nav>  
        <!-- NAVBAR END //-->
