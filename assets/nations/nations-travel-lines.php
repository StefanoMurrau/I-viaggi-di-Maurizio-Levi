
<!-- TRAVEL-LINES START //-->
<section id="travel-lines-nazioni">
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card">
                    <div class="card-img"></div>
                    <div class="card-img-overlay">
                        <p class="payoff mb-2"><?php echo $data['payoff']; ?></p>
                        <h2 class="title mb-4"><?php echo $data['title']; ?></h2>
                        <p class="text"><?php echo $data['text']; ?></p>
                    </div>
                </div>
            </div>
            <?php foreach ($data['trips'] as $key => $trip) { ?>
            <div class="col">
                <div class="card" style="background-image: url('<?php echo $trip['image']; ?>');">
                    <div class="card-img-overlay h-100">
                        <h5 class="card-payoff"><?php echo $trip['length']; ?> giorni</h5>
                        <h2 class="card-title"><?php echo $trip['title']; ?></h2>
                        <p class="card-text"><?php echo (strlen($trip['excerpt']) > 70) ? substr($trip['excerpt'], 0, strrpos(substr($trip['excerpt'], 0, 64), ' ')) . ' [...]' : $trip['excerpt']; ?></p>
                        <button type="button" class="levi-secondary-btn" href="<?php echo $trip['cta']; ?>">Scopri il viaggio</button>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- TRAVEL-LINES END //-->