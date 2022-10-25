<?php

	setlocale(LC_ALL, 'it_IT.UTF-8');

	$period = $_GET['period'];
	$base_url = base_url();

	if (strlen($period) <= 0) 
		{
		$period = date('Y-m-d');
		}

	function italian_month($date){
		
		$italian_month = 0;
		if     ($date =="01") {
			$italian_month = "Gennaio";
		}elseif($date =="02") {
			$italian_month = "Febbraio";
		}elseif($date =="03") {
			$italian_month = "Marzo";
		}elseif($date =="04") {
			$italian_month = "Aprile";
		}elseif($date=="05") {
			$italian_month = "Maggio";
		}elseif($date=="06") {
			$italian_month = "Giugno";
		}elseif($date =="07") {
			$italian_month = "Luglio";
		}elseif($date =="08") {
			$italian_month = "Agosto";
		}elseif($date =="09") {
			$italian_month = "Settembre";
		}elseif($date =="10") {
			$italian_month = "Ottobre";
		}elseif($date =="11") {
			$italian_month = "Novembre";
		}elseif($date =="12") {
			$italian_month = "Dicembre";
		}

		return $italian_month;
	}
	function mc_apicall_departures($period)
		{
		$URL = "https://klsgp.kel12.it";
		$ENDPOINT = "/api/Viaggi/ViaggiPartenze";

		$d = new DateTime($period);
		$lastDateOfMonth = $d->format('Y-m-t');

		$textToEncrypt = strftime("%Y%m%d%H%M%S");
		$encryptionMethod = "AES-256-CBC";
		$secretHash = "Kel12VLB2022";

		$token = openssl_encrypt($textToEncrypt, $encryptionMethod, $secretHash);

		$postRequest = array(
			"dataPartenzaDa" => $period,
			"dataPartenzaA" => $lastDateOfMonth,
			"flPubblicareLevi" => true,
			"token" => $token
		);


		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $URL . $ENDPOINT);
		curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($postRequest));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Content-Type:application/json',
			'Content-length: ' . strlen(json_encode($postRequest))
		));

		$response = curl_exec($curl);
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		curl_close($curl);

		return array('httpcode' => $httpcode, "response" => json_decode($response, true));
		}


	function mc_apicall_departing_travels($id_viaggio)
		{
		$URL = "https://klsgp.kel12.it";
		$ENDPOINT = "/api/Viaggi/Viaggi";

		$textToEncrypt = strftime("%Y%m%d%H%M%S");
		$encryptionMethod = "AES-256-CBC";
		$secretHash = "Kel12VLB2022";

		$token = openssl_encrypt($textToEncrypt, $encryptionMethod, $secretHash);

		$postRequest = array(
			"idViaggioKel" => $id_viaggio,
			"token" => $token
		);


		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $URL . $ENDPOINT);
		curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($postRequest));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Content-Type:application/json',
			'Content-length: ' . strlen(json_encode($postRequest))
		));

		$response = curl_exec($curl);
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		curl_close($curl);

		return array('httpcode' => $httpcode, "response" => json_decode($response, true));
		}


	$departures = mc_apicall_departures($period);
	$numero_partenze = count($departures['response']);





?>


	<section id="travel-lines-console" style="margin-top:8%; background-image: linear-gradient(#fff,#fff);">
		<div class="container" style="padding: top 120px;">
			<div class="row gx-2">

				<?php

					$base_url = base_url();
					$date = date('Y-m') . "-01";

					$date = new DateTime($date);

					$italian_month = italian_month($date->format('m'));

				?>

				<div class="col-sm-6 col-md-4 col-lg-2">
					<a href="<?php echo $base_url; ?>/departures.php?period=<?php echo $date->format('Y-m-d'); ?>#partenze" style="text-decoration:none">
						<button style="width:200px ;" class="m-2 levi-primary-btn"><?php echo $italian_month ." " .$date->format('Y') ; ?></button>
					</a>
				</div>

				<?php

					for($i = 1; $i <= 11; $i++) 
						{
						$interval = new DateInterval('P1M');
						$date->add($interval);
						$italian_month = italian_month($date->format('m'));

				?>
					
					<div class="col-sm-6 col-md-4 col-lg-2">
						<a href="<?php echo $base_url; ?>/departures.php?period=<?php echo $date->format('Y-m-d'); ?>#partenze" style="text-decoration:none">
							<button style="width:200px ;" class="m-2 levi-primary-btn"><?php echo $italian_month ." " .$date->format('Y') ; ?></button>
						</a>
					</div>

				<?php

					}

				?>

			</div>
		</div>
	</section>

<?php

	if($numero_partenze > 0)
		{ 
			
?>

	<!-- DEPARTURES START //-->
	<section id="travel-lines">
		<div class="container">
			<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
				<div class="col">
					<div class="card">
						<div class="card-img"></div>
						<div class="card-img-overlay">
							<!-- <p class="payoff mb-2"><?php echo $data['payoff']; ?></p> //-->
							<p class="payoff mb-2">SCEGLI<br />LA TUA PARTENZA</p>
							<h2 class="card-title mb-4"><?php echo $data['title']; ?></h2>
							<!-- <p class="card-text"><?php echo $data['text']; ?></p> //-->
							<p class="card-text">Trova la data di viaggio più adatta alle tue esigenze, lasciati ispirare e parti con noi per emozioni memorabili</p>
						</div>
					</div>
				</div>

				<?php

				$ii = 0;

				foreach($departures['response'] as $travel) 
					{
					$data_viaggio = $travel['dataPartenza'];

					$newDate = date("d/m/Y", strtotime(substr($travel['dataPartenza'], 0, 10)));

					$arr_viaggi = mc_apicall_departing_travels($travel['idViaggioKel']);

					foreach ($arr_viaggi['response'] as $mc_viaggio) 
						{
						$titoloViaggio = $mc_viaggio['titoloViaggio'];
						$nazioneViaggio = $mc_viaggio['nazione'];
						}

					$img_data = mc_get_img_banner_viaggi ('LEVI', $travel['idViaggioKel'] , 'BANNER-VIAGGIO', $conn, constant("KEL12_IMAGE_BASE_URL")) ; 
					$url = $img_data["url_foto"] ;

					$l = explode(" ", $titoloViaggio);

					if(count($l) == 2) 
						{
						$newline = $l[0] . "<br/>" . $l[1];
						} 
					else 
						{
						$newline = $titoloViaggio;;
						}

				?>

				<div class="col">
					<div class="card" style="background-image: url('<?php echo $url ?>') ;">
						<div class="card-img-overlay h-100">
							<h5 class="card-payoff"  style="text-transform: uppercase;font-weight: 300;font-size: calc(0.6rem + 0.4vw);color: white;"><?php echo $nazioneViaggio; ?></h5>    
							<h5 class="card-title" style="color: #fff;font-weight: 500;font-size: calc(1.2rem + 0.3vw);text-transform: uppercase;margin-bottom: 20px"><?php echo $newline; ?></h5>
							<a href="<?php echo $base_url; ?>/single-travel.php?id=<?php echo $travel['idViaggioKel']; ?>">
								<button class="levi-secondary-btn">Scopri di più</button>
							</a>
							<p style="text-transform: uppercase;font-weight: 300;font-size: calc(0.6rem + 0.4vw);position: absolute; bottom: 60px;color: white;"><?php echo $newDate; ?></p>
						</div>
					</div>
				</div>

				<?php

					$ii = $ii + 1;
					}

					if(!$ii) 
						{
						echo "Siamo spiacenti non sono previste partenze in questo mese.";
						}

				?>

			</div>
		</div>
	</section>
	<!-- DEPARTURES END //-->

<?php

		} 
	else 
		{ 
		echo "Siamo spiacenti non sono ancora programmate peratenze in questo mese." ;
		}
			
?>