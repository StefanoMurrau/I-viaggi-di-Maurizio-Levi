<?php

$id_tl= $_GET['id'];
$base_url = get_base_url();

$arr_tl = mc_apicall_viaggio_tl($id_tl);

if (strlen($period) <= 0) {
	$period = date('Y-m-d');
}
date_default_timezone_set('UTC');
setlocale(LC_ALL, 'it_IT.UTF-8');
define('DRIVER', 'mysql');
define('DB_HOST', '209.124.66.8');
define('DB_NAME', 'kelimage_application');
define('DB_USER', 'kelimage_mare_consulting');
define('DB_PASSWORD', 'MareConsulting71!');
define('DB_ENCODING', 'utf8');
define('DB_PORT', '3306');

try {
	$conn = new PDO("mysql:host=" .  constant('DB_HOST') . ";dbname=" . constant('DB_NAME') . ";user=" . constant('DB_USER') . ";password=" . constant('DB_PASSWORD') . ";options='--client_encoding=" . constant('DB_ENCODING') . "'");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
} catch (PDOException $e) {
	echo "CONNESSIONE FALLITA: " . $e->getMessage();
}


function mc_apicall_departures($id_tl)
{
	$URL = "https://klsgp.kel12.it";
	$ENDPOINT = "/api/Viaggi/ViaggiPartenze";

	$textToEncrypt = strftime("%Y%m%d%H%M%S");
	$encryptionMethod = "AES-256-CBC";
	$secretHash = "Kel12VLB2022";

	$token = openssl_encrypt($textToEncrypt, $encryptionMethod, $secretHash);

	$postRequest = array(
        "idKelTourLeader" => $id_tl,
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

function mc_apicall_departures_kel($id_tl)
{
	$URL = "https://klsgp.kel12.it";
	$ENDPOINT = "/api/Viaggi/ViaggiPartenze";

	$textToEncrypt = strftime("%Y%m%d%H%M%S");
	$encryptionMethod = "AES-256-CBC";
	$secretHash = "Kel12VLB2022";

	$token = openssl_encrypt($textToEncrypt, $encryptionMethod, $secretHash);

	$postRequest = array(
        "idKelTourLeader" => $id_tl,
		"flPubblicareKel12" => true,
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


$departures = mc_apicall_departures($id_tl);
$numero_partenze = count($departures['response']);

$departures_kel = mc_apicall_departures_kel($id_tl);
$numero_partenze_kel = count($departures_kel['response']);


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
						<!-- <p class="payoff mb-2"><?php echo $data['payoff']; ?></p> //-->
						<p class="payoff mb-2">PARTI<br />INSIEME A</p>
						<h2 class="card-title mb-4"><?php echo $arr_tl['response'][0]['nomeTourLeader'];?>&nbsp;<?php echo $arr_tl['response'][0]['cognomeTourLeader'];?></h2>
						<!-- <p class="card-text"><?php echo $data['text']; ?></p> //-->
						<p class="card-text">&nbsp;</p>
					</div>
				</div>
			</div>
			<?php /* foreach ($data['lines'] as $key => $line) { */ ?>
			<?php



			$ii = 0;
			foreach ($departures['response'] as $travel) {
				//echo "daaaaaaaaaaaaaata partenza: " .$travel['dataPartenza'];
				$data_viaggio = $travel['dataPartenza'];

				$newDate = date("d/m/Y", strtotime(substr($travel['dataPartenza'], 0, 10)));

				$arr_viaggi = mc_apicall_departing_travels($travel['idViaggioKel']);

				foreach ($arr_viaggi['response'] as $mc_viaggio) {
					$titoloViaggio = $mc_viaggio['titoloViaggio'];
				}


				try {
					$immagine_copertina = $base_url ."/img/levi-logo.svg";
					$a = mc_get_img_banner_viaggi('LEVI', $travel['idViaggioKel'], 'BANNER-VIAGGIO', $conn, 'https://kel12image.com/');

					if ($a) {
						$immagine_copertina = $a['url_foto'];
					} 
				} catch (Exception $e) {
					// an error occurred
					//echo $e->getMessage();

				}

				
				$l = explode(" ", $titoloViaggio);
				if (count($l) == 2) {
					$newline = $l[0] . "<br/>" . $l[1];
				} else {
					$newline = $titoloViaggio;;
				}
				
				?>


				<div class="col">
					<div class="card" style="background-image: url('<?php echo $immagine_copertina ?>') ;">
						<div class="card-img-overlay h-100">
							<!-- <img src="img/levi-logo.svg" alt="Logo Levi">
                            <p class="additional-text-paragraph"><?php echo $newDate; ?></p> -->
							<h5 class="card-title"><?php echo $newline; ?></h5>
							<a href="<?php echo $base_url; ?>/single-travel.php?id=<?php echo $travel['idViaggioKel']; ?>">
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

} else { 

	//echo "Siamo spiacenti non sono ancora programmate  peratenze in questo mese.";
}


if($numero_partenze_kel > 0)
{ 
	$arr_t = array_map('trim', $arr_t);
	$arr_tl['response'][0]['nomeTourLeader'];
	$arr_tl['response'][0]['cognomeTourLeader'];
	$link_tl = $arr_tl['response'][0]['nomeTourLeader'] . "-" .$arr_tl['response'][0]['cognomeTourLeader'];
	$link_tl = str_replace(" ", "" , $link_tl);


?>

	<section id="mission">
	<div class="container">
		<div class="row g-4">
			<div class="col-12">
				
				<div style="text-align: center;">
				<h2 class="title">Scopri le partenze di <?php echo $arr_tl['response'][0]['nomeTourLeader'];?>&nbsp;<?php echo $arr_tl['response'][0]['cognomeTourLeader'];?> con i viaggi Kel 12</h2>
				<a href="https://kel12.com/tourleader/<?php echo trim($link_tl);?>/">
				<button class="levi-secondary-btn">Vai al sito Kel 12</button>
				</a>	
			</div>
			</div>
		</div>
</section>

<?php

}



			
?>
<!-- TRAVEL-LINES END //-->