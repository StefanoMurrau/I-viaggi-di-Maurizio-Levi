<?php
$id_nazione = $_GET['id'];

$ii = 0;

$data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "nations-travels/". (string)$id_nazione, "levi") ;

?>


<!-- NATION-CARDS START //-->
<section id="travel-lines">
    <div class="nations-travels">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <div class="col">
                    <div class="card">
                        <div class="card-img"></div>
                        <div class="card-img-overlay">
                            <p class="payoff mb-2"><?php echo $data["nations-travels"][0]['payoff']; ?></p>
                            <h2 class="card-title mb-4"><?php echo $data["nations-travels"][0]['title']; ?></h2>
                            <p class="card-text"><?php echo $data["nations-travels"][0]['text']; ?></p>
                        </div>
                    </div>
                </div>

                <?php

                $ii = 0;
                foreach ($data["nations-travels"][0]['travels'] as $viaggio) {
                    try {
                        $a = mc_get_img_banner_viaggi('LEVI', $viaggio['id'], 'BANNER-VIAGGIO', $conn, constant("KEL12_IMAGE_BASE_URL")) ; 
                    } catch (Exception $e) {
                        // an error occurred
                        //echo $e->getMessage();

                    }

             
                ?>
                    <div class="col">
                        <div class="card" style="background-image: url('<?php echo $a["url_foto"] ?>') ;">
                            <div class="card-img-overlay h-100">

                                <?php
                                $newline = "";
                                $l = explode(" ", $viaggio['title']);
                                if (count($l) == 2) {
                                    $newline = $l[0] . "<br/>" . $l[1];
                                } else {
                                    $newline = $viaggio['title'];
                                }
                                ?>

                                <h5 style="position: absolute; bottom: 60px; font-size: 1.5vw; color: white; " class="card-payoff"><?php echo $viaggio['length']; ?> giorni</h5>
                                <p style="color: white; font-size: 1.5vw;">A partire da: <?php echo $viaggio['starting_price'] . " &euro;"; ?>
                                <h5 class="card-title m-2"><?php echo $newline; ?></h5>                   
                                    <a href="/single-travel.php?id=<?php echo $viaggio['id']; ?>">
                                        <button class="levi-secondary-btn">Scopri di più</button>
                                    </a>
                             
                                </p>
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
    </div>

</section>

<!-- NATION-CARDS END //-->