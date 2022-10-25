<?php

    $data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "logo-carousel", "levi") ; 

?>

<!-- LOGOS START //-->
<?php if( array_key_exists("logos", $data) && !empty($data["logos"]) ){ ?>

<section id="logo-carousel">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="owl-carousel owl-theme">

                    <?php foreach ($data["logos"] as $logo) { ?>
                     
                        <div class="item">
                            <img src="img/<?php echo $logo['image']; ?>" alt="<?php echo $logo['title'] ; ?>">
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
        </div>
</section>

<?php } ?>
<!-- LOGOS END //-->