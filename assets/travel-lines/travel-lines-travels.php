<?php
	$cod_linea_viaggio = $_GET['id'] ;
	
	$data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "travel-line-travels/". (string)$cod_linea_viaggio, "levi") ;
	
	$numero_viaggi = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "utility/count-travels-travel-lines/levi/". (string)$cod_linea_viaggio, "klsgp") ;
	
	$numero_viaggi = $numero_viaggi["count"];
	
?>

        <!-- travel-line-travels START //-->
		
        <section id="travel-line-travels">
            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

				<?php
					if($numero_viaggi > 0)
						{
				?>
						<div class="col">
							<div class="card">
								<div class="card-img"></div>
								<div class="card-img-overlay">
									<p class="payoff mb-2"><?php echo  $data['travel-line-travels'][0]['payoff'] ; ?> </p>
									<h2 class="card-title mb-4"><?php echo  $data['travel-line-travels'][0]['title'] ; ?></h2>
									<p class="card-text"><?php echo  $data['travel-line-travels'][0]['text'] ; ?></p>
								</div>
							</div>
						</div>
                    
                <?php 

					$ii= 0;

                    foreach( $data['travel-line-travels'][0]['travels'] as $travel )
                    	{
						$immagine_copertina = "/img/levi-logo.svg" ;

						try 
							{
							$a = mc_get_img_banner_viaggi ('LEVI', $travel['id'] , 'BANNER-VIAGGIO', $conn, constant("KEL12_IMAGE_BASE_URL"));
							
							if($a)
								{
								$immagine_copertina = $a['url_foto']; 
								} 
							} 
						catch(Exception $e) 
							{
							$e->getMessage();	
							}
						
					$l = explode(" ", $travel['title']) ;

					if( count($l) == 2 )
						{
						$newline = $l[0] . "<br/>" . $l[1] ;
						}
					else
						{
						$newline =$travel['title']; 
						}
					$testoPerSito = strip_tags($travel['excerpt'])

				?>

						<div class="col">

						<div class="card" style="background-image: url('<?php echo $immagine_copertina ?>') ;">
							<div class="card-img-overlay h-100">
			
							<?php

								$l = explode(" ", $travel['title']) ;
						
								if( count($l) == 2 )
									{
									$newline = $l[0] . "<br/>" . $l[1] ;
									}
								else
									{
									$newline =  $travel['title']; ;
									}

							?>


                                <h5 style="position: absolute; bottom: 60px; font-family: 'Playfair Display', serif; font-size: calc(1.1rem + 0.3vw); color: #fff; text-transform: uppercase; font-weight: 300; font-size: calc(0.6rem + 0.4vw);" class="card-payoff"><?php echo $travel['length']; ?> giorni</h5>
                                <h5 class="card-payoff" style="font-family: 'Playfair Display', serif; font-size: calc(1.1rem + 0.3vw); color: #fff; text-transform: uppercase; font-weight: 300; font-size: calc(0.6rem + 0.4vw);"><?php echo $travel['nation']; ?></h5>
								<h5 class="card-title"><?php echo ucfirst(strtolower($newline)); ?></h5>
								<a href="/single-travel.php?id=<?php echo $travel['id']; ?>">
									<button class="levi-secondary-btn">Scopri di più</button>
								</a>
									
							</div>
						</div>
					</div> 

				<?php 

						$ii= $ii + 1;
						} 
						if(!$ii) 
							{ 
							//echo "Siamo spiacenti." ;
							}
				} 
				else 
					{
					echo "Siamo spiacenti non sono presenti viaggi per questa linea di viaggio." ;
					}

				?>

				</div>
			</div>
		</section>
		<!-- TRAVEL-LINES END //-->