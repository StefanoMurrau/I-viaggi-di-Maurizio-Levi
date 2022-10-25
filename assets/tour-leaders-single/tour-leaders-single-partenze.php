<?php

$id_tl= $_GET['id'];

// $departures = mc_apicall_departures($id_tl);
// $numero_partenze = count($departures['response']);

// $departures_kel = mc_apicall_departures_kel($id_tl);
// $numero_partenze_kel = count($departures_kel['response']);


$data = mc_middleware_call(constant("MIDDLEWARE_BASE_URL"), "tour-leader-travels/".$id_tl, "levi") ;
$numero_partenze = mc_middleware_call(constant("MIDDLEWARE_BASE_URL"), "utility/count-departing-travels-tour-leader/levi/".$id_tl, "klsgp") ;
$numero_partenze_kel12 = mc_middleware_call(constant("MIDDLEWARE_BASE_URL"), "utility/count-departing-travels-tour-leader/".$id_tl, "klsgp") ;
$data_tour_leader = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "tour-leaders-single/".$_GET['id'], "levi") ;
$numero_partenze = $numero_partenze["count"];
$numero_partenze_kel12 = $numero_partenze_kel12["count"];

if($numero_partenze > 0)
{ 
			
?>

<!-- TRAVEL-LINES START //-->
<section id="travel-lines">
	<div class="container">
		<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
			<div class="col">
				<div class="card">
					<div class="card-img"></div>
					<div class="card-img-overlay">
						<!-- <p class="payoff mb-2"><?php echo $data['tour_leader_travels']['payoff']; ?></p> //-->
						<p class="payoff mb-2"><?php echo $data['tour_leader_travels']['payoff'];?></p>
						<h2 class="card-title mb-4"><?php echo $data['tour_leader_travels']['title'];?></h2>
						<!-- <p class="card-text"><?php echo $data['text']; ?></p> //-->
						<p class="card-text"><?php echo $data['tour_leader_travels']['text'];?></p>
					</div>
				</div>
			</div>
			<?php /* foreach ($data['lines'] as $key => $line) { */ ?>
			<?php


			$ii = 0;
			foreach ($data['tour_leader_travels']['travels'] as $travel) {
				//echo "daaaaaaaaaaaaaata partenza: " .$travel['dataPartenza'];
				$data_viaggio = $travel['departure_date'];
				
				$newDate = date("d/m/Y", strtotime(substr($travel['departure_date'], 0, 16)));
				try {
					$immagine_copertina = $base_url ."/img/levi-logo.svg";
					$a = mc_get_img_banner_viaggi('LEVI', $travel['id_travel_kel'], 'BANNER-VIAGGIO', $conn, 'https://kel12image.com/uploads/');

					if ($a) {
						$immagine_copertina = $a['url_foto'];
					} 
				} catch (Exception $e) {
					// an error occurred
					//echo $e->getMessage();

				}

				
				$l = explode(" ", $travel['title']);
				if (count($l) == 2) {
					$newline = $l[0] . "<br/>" . $l[1];
				} else {
					$newline = $travel['title'];;
				}
				
				?>


				<div class="col">
					<div class="card" style="background-image: url('<?php echo $immagine_copertina ?>') ;">
						<div class="card-img-overlay h-100">
							<!-- <img src="img/levi-logo.svg" alt="Logo Levi">
                            <p class="additional-text-paragraph"><?php echo $newDate; ?></p> -->
							<h5 class="card-title"><?php echo $newline; ?></h5>
							<a href="single-travel.php?id=<?php echo $travel['id_travel_kel']; ?>">
								<button class="levi-secondary-btn">Scopri di più</button>
							</a>
							<p style="color: white;     text-align: center;     font-size: 1.5vw;"><?php echo $newDate; ?></p>
						</div>
					</div>
				</div>
			<?php
				$ii = $ii + 1;
			}
			

			?>
		</div>
	</div>
</section>


<?php

}


if($numero_partenze_kel12 > 0)
{ 
	
	$link_tl = $data_tour_leader["tour_leader_single"][0]["firstname_tour_leader"] . "-" . $data_tour_leader["tour_leader_single"][0]["lastname_tour_leader"] ;
	$link_tl = str_replace(" ", "" , $link_tl) ;


?>

<style>
#mission-kel12{
	background-color: #e0c9aa;
}
#mission-kel12 .container {
    padding-top: 8%;
    padding-bottom: 8%;
}
#mission-kel12 .title {
    font-family: 'Playfair Display', serif;
    font-size: calc(1.1rem + 0.3vw);
    color: #a06b1b;
    text-transform: uppercase;
    font-weight: 300;
    text-align: center;
	margin-bottom: 40px;
}
</style>

<section id="mission-kel12" >
	<div class="container">
		<div class="row g-4">
			<div class="col-12">
				<div style="text-align: center;">
					<h2 class="title">Scopri le partenze di <?php echo $data_tour_leader["tour_leader_single"][0]["firstname_tour_leader"];?>&nbsp;<?php echo $data_tour_leader["tour_leader_single"][0]["lastname_tour_leader"];?> con i viaggi Kel 12</h2>
					<a href="https://kel12.com/tourleader/<?php echo trim($link_tl);?>/">
						<button class="levi-secondary-btn">Vai al sito Kel 12</button>
					</a>	
				</div>
			</div>
		</div>
	</div>
</section>

<?php

}



			
?>
<!-- TRAVEL-LINES END //-->