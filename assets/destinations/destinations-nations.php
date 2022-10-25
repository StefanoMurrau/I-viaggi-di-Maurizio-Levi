<?php

$id_area_geo = $_GET['id'];

$ii = 0;

$data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "destinations-nations/". (string)$id_area_geo, "levi") ;
?>

<!-- NATION-CARDS START //-->
<section id="travel-lines">
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <div class="col">
                <div class="card">
                    <div class="card-img"></div>
                    <div class="card-img-overlay">
                        <p class="payoff mb-2"><?php echo $data['destinations-nations'][0]['payoff']; ?></p> 
                        <!-- <p class="payoff mb-2">DESTINATIONS...... <br />LA TUA PARTENZA  </p> -->
                        <h2 class="card-title mb-4"><?php echo $data['destinations-nations'][0]['title']; ?></h2>
                        <p class="card-text"><?php echo $data['destinations-nations'][0]['text']; ?></p>
                    </div>
                </div>
            </div>
            <?php /* foreach ($data['lines'] as $key => $line) { */ ?>
            <?php



            $ii = 0;
            foreach ($data['destinations-nations'][0]['nations'] as $nation) {
   
            try 
            {
                $immagine_copertina = "/img/levi-logo.svg";
                $a = mc_get_img_nazione ('LEVI', $nation['id'] , 'CARD-NAZIONI', $conn);
                
                if ($a) {
                    $immagine_copertina = $a['url_foto'];
                } 
            } catch (Exception $e) {
                // an error occurred
                //echo $e->getMessage();

            }
      
            ?>
            <div class="col">
                <div class="card" style="background-image: url('<?php echo $immagine_copertina ?>') ;">
                    <div class="card-img-overlay h-100">
                        
                        <?php
                            $newline = "";
                            $l = explode(" ", $nation['label']);
                            if (count($l) == 2) {
                                $newline = $l[0] . "<br/>" . $l[1];
                            } else {
                                $newline = $nation['label'];
                            }
                            ?>

                        <h5 class="card-title"><?php echo $newline; ?></h5>


                        <a href="/nations.php?id=<?php echo $nation['id']; ?>">
                            <button class="levi-secondary-btn">Scopri di più</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
                $ii = $ii + 1;
            }
            if (!$ii) {
                echo "Siamo spiacenti non sono previste partenze in questo mese.";
            }

            ?>
        </div>
    </div>
</section>

<!-- NATION-CARDS END //-->
