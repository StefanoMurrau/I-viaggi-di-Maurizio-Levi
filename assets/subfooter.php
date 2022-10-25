<?php

    $data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "subfooter", "levi") ;

?>

        <!-- SUBFOOTER START //-->
        <?php if( array_key_exists("infos", $data) && !empty($data["infos"]) ){ ?>

        <section id="subfooter">
            <div class="container">
                <div class="row g-0">
                    <div class="col-12 col-sm-12">
                        <ul>

                        <?php foreach( $data["infos"] as $info ) { ?>

                            <li class="align-self-center"><?php echo $info['label'] ; ?></li>
                            <hr />
                            
                        <?php } ?>

                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <?php } ?>
        <!-- SUBFOOTER END //-->


        <!-- jQuery //-->
        <script src="../lib/jquery-3.6.0.min.js"></script>

        <!-- jQuery Easing //-->
		<script src="../lib/jquery-easing/jquery.easing.js"></script>

        <!-- Option 1: Bootstrap Bundle with Popper //-->
        <script src="../lib/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- OwlCarousel Js //-->
        <script src="../lib/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>

        <!-- Google Recaptcha //-->
        <script src='https://www.google.com/recaptcha/api.js'></script>

        <!-- Lightgallery core Js //-->
        <script src="../lib/lightGallery/dist/lightgallery.umd.js"></script>
        <script src="../lib/lightGallery/dist/plugins/zoom/lg-zoom.umd.js"></script>
        <script src="../lib/lightGallery/dist/plugins/thumbnail/lg-thumbnail.umd.js"></script>
        <script src="../lib/lightGallery/dist/plugins/fullscreen/lg-fullscreen.umd.js"></script>
        <script src="../lib/lightGallery/dist/plugins/autoplay/lg-autoplay.umd.js"></script>

        <!-- App Js //-->
        <script src="../js/main.js"></script>

    </body>