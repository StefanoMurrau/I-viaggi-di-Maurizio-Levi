<!-- LOGOS START //-->
<section id="logos">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="owl-carousel owl-theme">

                    <?php foreach ($data as $key => $logo) { ?>

                        <div class="item">
                            <img src="img/<?php echo $logo['image']; ?>" alt="<?php echo $logo['title'] ; ?>">
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
        </div>
</section>
<!-- LOGOS END //-->