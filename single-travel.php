<?php 

	require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "settings.php" ) ;
	require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "functions.php" ) ;
	require_once( __DIR__ . DIRECTORY_SEPARATOR . "private" . DIRECTORY_SEPARATOR . "dbconn.php" ) ;

	$id_viaggio = 0 ;
	$id_viaggio = $_GET['id'] ;
	$base_url = base_url() ;

	$viaggio_klsgp = 0;
    function mc_apicall_viaggio($id_viaggio)
        {
        $URL = "https://klsgp.kel12.it" ;
        $ENDPOINT = "/api/Viaggi/Viaggi" ;

		$textToEncrypt = strftime("%Y%m%d%H%M%S") ;
		$encryptionMethod = "AES-256-CBC" ;
		$secretHash = "Kel12VLB2022" ;

		$token = openssl_encrypt($textToEncrypt, $encryptionMethod, $secretHash) ;

		$postRequest = array(
			"idViaggioKel" => $id_viaggio,
			"token" => $token
		) ;

		$curl = curl_init() ;
		curl_setopt($curl, CURLOPT_URL, $URL . $ENDPOINT)	;
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postRequest)) ;
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1) ;
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Content-Type:application/json',
			'Content-length: ' . strlen(json_encode($postRequest))
		)) ;

        $response = curl_exec($curl) ;
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE) ;

        curl_close($curl) ;

        return array('httpcode' => $httpcode, "response" => json_decode($response, true)) ;
        }


    $viaggio_klsgp = mc_apicall_viaggio($id_viaggio) ;


	if(!$viaggio_klsgp['response'] ){

		echo 'Siamo spiacenti, la tua navigazione in questa pagina non è correttamente abilitata';
		exit;
	}

	
	
	foreach($viaggio_klsgp['response'] as $key => $viaggio){
		 $flPartenzeSpeciali = $viaggio['flPartenzeSpeciali'];
		 $flPartenzeIndividuali = $viaggio['flPartenzeIndividuali'];
	}
	$intervallodate = 0;

	if ($flPartenzeIndividuali == 1 or $flPartenzeSpeciali == 1 ) {
		$intervallodate = 1;
			
	}


	

    function mc_apicall_daybyday($id_viaggio)
		{
		$URL = "https://klsgp.kel12.it" ;
		$ENDPOINT = "/api/Viaggi/ViaggiDayByDay" ;

		$textToEncrypt = strftime("%Y%m%d%H%M%S") ;
		$encryptionMethod = "AES-256-CBC" ;
		$secretHash = "Kel12VLB2022" ;

		$token = openssl_encrypt($textToEncrypt, $encryptionMethod, $secretHash) ;

		$postRequest = array(
			"idViaggioKel" => $id_viaggio,
			"token" => $token
		) ;

		$curl = curl_init() ;
		curl_setopt($curl, CURLOPT_URL, $URL . $ENDPOINT) ;
		curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($postRequest)) ;
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1) ;
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Content-Type:application/json',
			'Content-length: ' . strlen( json_encode($postRequest) )
		)) ;

		$response = curl_exec($curl) ;
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE) ;

		curl_close($curl) ;

		return array( 'httpcode' => $httpcode, "response" => json_decode($response, true)) ;
		}


    $viaggio_daybyday = mc_apicall_daybyday($id_viaggio ) ;
        

	$ii = 0 ;

	foreach( $viaggio_daybyday['response'] as $k=>$viaggio_giorno )
		{
		$id[$k]= $viaggio_giorno['idViaggioKel'] ;
        $giorno[$k] = $viaggio_giorno['giorno'] ;
		}
        
	array_multisort( $giorno,SORT_ASC,SORT_NUMERIC, $viaggio_daybyday['response'] ) ;
     
		
    function mc_apicall_viaggio_partenze($id_viaggio)
		{
		$URL = "https://klsgp.kel12.it" ;
		$ENDPOINT = "/api/Viaggi/ViaggiPartenze" ;

		$textToEncrypt = strftime("%Y%m%d%H%M%S") ;
		$encryptionMethod = "AES-256-CBC" ;
		$secretHash = "Kel12VLB2022" ;

		$token = openssl_encrypt($textToEncrypt, $encryptionMethod, $secretHash) ;

		$postRequest = array(
			"idViaggioKel" => $id_viaggio,
			"token" => $token
		) ;

		$curl = curl_init() ;
		curl_setopt($curl, CURLOPT_URL, $URL . $ENDPOINT) ;
		curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($postRequest)) ;
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1) ;
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Content-Type:application/json',
			'Content-length: ' . strlen( json_encode($postRequest) )
		)) ;

		$response = curl_exec($curl) ;
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE) ;

		curl_close($curl) ;

		return array( 'httpcode' => $httpcode, "response" => json_decode($response, true)) ;
		}

		
	$viaggio_partenze = mc_apicall_viaggio_partenze($id_viaggio ) ;

	      
		
	$ii = 0 ;
	$count_partenze = 0;
	foreach( $viaggio_partenze['response'] as $k=>$partenza )
		{
		$id[$k]= $partenza['idViaggioKel'] ;
        $datapartenza[$k] = $partenza['dataPartenza'] ;
		$count_partenze = $count_partenze + 1;
		}
        
	array_multisort($datapartenza,SORT_ASC,SORT_NUMERIC, $viaggio_partenze['response'] ) ;
          

	///area dedicata alla form di richiesta preventivo
	session_start();
	//prendo tutti i dati della pagina su cui sono: 
	$sitoweb = $_SERVER['SERVER_NAME'];  
	$pagina = $_SERVER['REQUEST_URI'];


	//Business Request
	$business_request_Subject = "Richiesta Preventivo i Viaggi di Maurizio Levi";
	$business_request_Desc = "Richiesta Preventivo i Viaggi di Maurizio Levi";
	$business_request_Product = $pagina;
	$business_request_Channel_Type = "web";
	$business_request_Channel_Name = $sitoweb;

	//// Prepare default data to insert in to varous table --> to modify in every site this code will be inserted 
	//email
	$admin_email    = 'info@viaggilevi.com';
	$admin_email_subject        = 'Richiesta Preventivo i Viaggi di Maurizio Levi';
	$admin_email_body          = ""; //file_get_contents('https://crmnet.it/wp-content/themes/public-opinion-child/dem_crmnet.html');
	$admin_email_headers_from  = "Richiesta Preventivo i Viaggi di Maurizio Levi <info@viaggilevi.com>";

	//$action = "https://riccardo-grassi.com/wp-content/themes/blockchain-child/mc_request_exe_ml.php";
	$action = "/assets/mc_request_exe_ml_levi.php" ;

	$referer = base_url();

?>


<!DOCTYPE html>

<html lang="it">

    <?php get_assets($asset = "header", "Viaggi") ; ?>

    
    <body>
    
        <?php get_assets("navbar") ; ?>
        <?php get_assets("hero", "", "single-travel" . DIRECTORY_SEPARATOR . "single-travel", $conn) ; ?>
        <?php get_assets("cta", "", "single-travel" . DIRECTORY_SEPARATOR . "single-travel") ; ?>
        <?php get_assets("gallery", "", "single-travel" . DIRECTORY_SEPARATOR . "single-travel", $conn) ; ?>
        <?php get_assets("main-info", "", "single-travel" . DIRECTORY_SEPARATOR . "single-travel") ; ?>
        <?php get_assets("additional-info", "", "single-travel" . DIRECTORY_SEPARATOR . "single-travel", $conn) ; ?>
		<?php get_assets("day-by-day", "", "single-travel" . DIRECTORY_SEPARATOR . "single-travel") ; ?>
		<?php get_assets("gallery2", "", "single-travel" . DIRECTORY_SEPARATOR . "single-travel") ; ?>
		<?php get_assets("cta-end", "", "single-travel" . DIRECTORY_SEPARATOR . "single-travel") ; ?>

		
		<!-- Modal -->
		<div class="modal fade" id="mc_cta_modal" tabindex="-1" aria-labelledby="mc_cta_modal_Label" aria-hidden="true">
			<div class="modal-dialog">
				<form id="business_request" name="business_request" method="post" action="<?php echo $action; ?>">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="mc_cta_modal_Label">Richiedi preventivo</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<input type="text" class="levi-input form-control mb-2" placeholder="Nome*" name="PersonName" id="PersonName" value="" required>
							<input type="text" class="levi-input form-control mb-2" placeholder="Cognome*" name="PersonSurname" id="PersonSurname" value="" required>
							<input type="email" class="levi-input form-control mb-2" placeholder="E-mail*" name="PersonEmail" id="PersonEmail" value=""  required>
							<input type="text" class="levi-input form-control mb-2" placeholder="Telefono" name="PersonTel" id="PersonTel" value="" >


							<input type="hidden" class="levi-input form-control mb-2" placeholder="IDVIAGGIOKEL" name="idViaggioKel12" id="idViaggioKel12" value="<?php echo $id_viaggio; ?>" >
							
							<label for="PersonAdultNum">N° ADULTI*</label><br>
                            <input type="number" class="levi-input form-control mb-2" placeholder="N° ADULTI*" max="20" name="PersonAdultNum" id="PersonAdultNum" pattern="[0-9]" required value="2" min="0">
                            <label for="PersonChildNum">N° BAMBINI</label><br>
							<input type="number" class="levi-input form-control mb-2" placeholder="N° BAMBINI" name="PersonChildNum" id="PersonChildNum" max="20" pattern="[0-9]" required value="0" min="0">
							
									
							
							<?php 
													

							$endDate = date('Y-m-d', strtotime('+3 days'));
							$minDate = date('Y-m-d', strtotime('+1 days'));
						
												
							if ($intervallodate) {

								?>
								<h5 class="modal-title" id="mc_cta_modal_Label">Viaggio su misura per te:</h5>
								
								<input type="date" name="datadaBASE" id="datadaBASE" value="" class="levi-input form-control mb-2" placeholder="PARTENZA NON PRIMA DEL &nbsp; &nbsp;" required >
								<input type="date" name="dataaBASE" id="dataaBASE" class="levi-input form-control mb-2" placeholder="RITORNO NON DOPO IL &nbsp; &nbsp;" required>
							
								<?php
							
							}



							if ($count_partenze >= 1) {
							?>
								<div class="form-group">
									<h5 class="modal-title" id="mc_cta_modal_Label">Date partenze gruppi:</h5>
									<select name="iddatapartenzaBASE" id="iddatapartenzaBASE">
										<option value="11111">Seleziona una data</option>
										<?php
										foreach( $viaggio_partenze['response'] as $k=>$partenza )
										{
										$id[$k]= $partenza['idPartenzaKel'] ;
										$datapartenza[$k] = $partenza['dataPartenza'] ;
										$dataini = date('d/m/Y', strtotime($datapartenza[$k]));	

										?>
										<option value="<?php echo $id[$k]; ?>"><?php echo $dataini; ?></option>
										<?php
										//} 
										}
										?>
									</select>
								</div>
							<?php
							}
							?>
							<textarea type="text" rows="3" class="levi-input form-control" placeholder="Lascia il tuo messaggio*" required name="ReqDesc"></textarea>
							<label class="levi-label p-1" for="privacy_1">
								<input type="checkbox" class="form-check-input" id="privacy_1" name="privacy1" required>
								Ho preso visione dell' informativa sulla privacy e presto il consenso a Kel 12 Tour Operator S.r.l. per il
								trattamento dei miei dati personali.* 
							</label>
							<label class="levi-label p-1" for="privacy_2">
								<input type="checkbox" class="form-check-input" id="privacy_2" name="privacy2" required>
								Presto il consenso al trattamento dei miei dati personali per l'invio tramite sms e/o e-mail di
								comunicazioni informative e promozionali.* 
							</label>
							<label class="levi-label p-1" for="privacy_3">
								<input type="checkbox" class="form-check-input" id="privacy_3" name="privacy3" required>
								Presto il consenso al trattamento dei miei dati personali per l’iscrizione al servizio di invio newsletter
								in relazione alle iniziative proprie e/o di società controllate e/o collegate, nonché del nostro partner
								ufficiale National Geographic Partners LLC.*
							</label>
					
							<!--- Area Person - START -->
							<input type="hidden" name="admin_email" value="<?php echo $admin_email; ?>" />
							<input type="hidden" name="subject_email" value="<?php echo $subject_email; ?>" />
							<input type="hidden" name="body_email" value="<?php echo $body_email; ?>" />
							<input type="hidden" name="headers_from_email" value="<?php echo $headers_from_email; ?>" />
							<input type="hidden" name="referer" value="<?php echo $referer; ?>" />
							<input type="hidden" name="request_type" value="business_request" />
							<input type="hidden" name="PersonCountry" id="PersonCountry" value="" required  placeholder="Country *"/>
							<!--- Area Person - END -->

							<!--- Area Organization -->
							<input type="hidden" name="OrgName" id="OrgName" value=""  placeholder="Nome Azienda" />
							<input type="hidden" name="OrgCity" id="OrgCity" value=""  placeholder="Organization City" />
							<input type="hidden" name="OrgWebSite" id="OrgWebSite" value=""  placeholder="https://my-isola.com" />
							<!--- Area Organization - END -->


							
							<!--- Area Request -->
							<input type="hidden" name="ReqSubjet" id="ReqSubjet" value="<?php echo $business_request_Subject; ?>" />
							<input type="hidden" name="ReqProd" id="ReqProd" value="<?php echo $business_request_Product; ?>" />
							<input type="hidden" name="ReqType" id="ReqType" value="<?php echo $business_request_Channel_Type; ?>" />
							<input type="hidden" name="ReqName" id="ReqName" value="<?php echo $business_request_Channel_Name; ?>" />  
							<!--- Area Request - END -->

							<!-- <div class="g-recaptcha" data-sitekey="6LeJ7G0UAAAAAIPahRtWpSJ4GJCi8J2L6iWRF6Cl"></div> -->
						</form>
					</div>
					<div class="modal-footer">
						<!-- <button type="button" class="levi-primary-btn">Richiedi</button> -->
						<button type="submit" class="levi-primary-btn">Richiedi informazioni</button>
						<button type="button" class="levi-primary-btn" style="background-color:#6c757d ;color: #fff;" data-bs-dismiss="modal">Annulla</button>
					</div>
				</div>
			</div>
		</div>

        <?php get_assets("footer") ; ?>
        <?php get_assets("subfooter") ; ?>
       

</html>