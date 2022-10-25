<?php  

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
$_SESSION['business_request'] = "";


// function to geocode address, it will return false if unable to geocode address
function getUserIP() {
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}
function geocode($address){
    
    // url encode the address
    $address = urlencode($address);
     
    // google map geocode api url
    $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";
 
    // get the json response
    $resp_json = file_get_contents($url);
     
    // decode the json
    $resp = json_decode($resp_json, true);
    // echo $resp['status'];
    
    // response status will be 'OK', if able to geocode given address 
    if($resp['status']=='OK'){
 
        // get the important data
        $lati = $resp['results'][0]['geometry']['location']['lat'];
        $longi = $resp['results'][0]['geometry']['location']['lng'];
        $formatted_address = $resp['results'][0]['formatted_address'];
         
        // verify if data is complete
        if($lati && $longi && $formatted_address){
         
            // put the data in the array
            $data_arr = array();            
             
            array_push(
                $data_arr, 
                    $lati, 
                    $longi, 
                    $formatted_address
                );
             
            return $data_arr;
             
        }else{
            return false;
        }
         
    }else{
        return false;
    }
}

function richiedi_preventivo_ws1 ($email,$idViaggioKel,$NumAdulti,$NumBambini,$UlterioriRichieste,$datapartenza ){
    //echo "<br> SONO NELL FUNZIONE ws1";
    $businessClass 			= '0' ;
    $errorMessage = '';
    $client = '';
    $result = '';
    if (!isset($params)):
        $params = new stdClass();
    endif;	
    $idViaggioKel = (int)$num;
    $params->Email 						= $email;
    $params->idViaggioKel 				= (int)$idViaggioKel;
    $params->idDataPartenza 			= (int)$datapartenza;
    $params->idAeroporto                = '';
    $params->businessClass 				= (int)$businessClass;
    $params->numAdulti 					= (int)$NumAdulti;
    $params->numBambini 				= (int)$NumBambini;
    $params->richiesteUlteriori 		= $UlterioriRichieste;
    $params->daSito                     = "LEVI";
    $params->errorMessage 				= $errorMessage;
    $params->TagRegistrazione = '';
    $params->DataTagRegistrazione = '';
    
    
    //chiamo il webservice di richiesta preventivo
    ini_set('soap.wsdl_cache_enabled', '0'); 
    ini_set('soap.wsdl_cache_ttl', '0');
    ini_set('soap.wsdl_cache_limit', '0');
    //$client = new SoapClient("http://67.225.209.89/RichiestaPreventivo.asmx?WSDL");
    //$client = new SoapClient("http://www.kel12.it/RichiestaPreventivo.asmx?WSDL");
    $client = new SoapClient("http://89.34.16.229/RichiestaPreventivo.asmx?WSDL");
    $result = $client->RegistrazioneRichiestaNew($params);
    return $result;
}
function richiedi_preventivo_ws2 ($email,$idViaggioKel, $NumAdulti, $NumBambini, $UlterioriRichieste, $datada_prev,$dataa_prev, $descrizioneViaggio ){
    //echo "<br> SONO NELL FUNZIONE ws2";
    $businessClass 			= '0' ;
    $errorMessage = '';
    $client = '';
    $result = '';
    if (!isset($params)):
        $params = new stdClass();
    endif;	

    $params->email 						= $email;
    $params->idItinerario 				= $idViaggioKel;
    $params->numeroAdulti					= $NumAdulti;
    $params->numeroBambini 				= $NumBambini;
    $params->richiesteUlteriori 		= $UlterioriRichieste;
    $params->errorMessage 				= $errorMessage;
    $params->daSito					   =  "LEVI";
    $params->dataPartenza 				= $datada_prev;
    $params->dataRitorno 				= $dataa_prev;
    $params->descrizioneViaggio 		= $descrizioneViaggio;
    $params->aeroportoPartenza			= '';
    $params->budget                     = '';
    $params->businessClass 				= '';
    $params->tipoSistemazione 			= '';
    $params->linguaGuida				= '';
    $params->TagRegistrazione = '';
    $params->DataTagRegistrazione = '';
    //chiamo il webservice di richiesta preventivo con date libere (WS2)
    
    ini_set('soap.wsdl_cache_enabled', '0'); 
    ini_set('soap.wsdl_cache_ttl', '0');
    ini_set('soap.wsdl_cache_limit', '0');
    
    //$client = new SoapClient("http://67.225.209.89/RichiestaPreventivo.asmx?WSDL");
    //$client = new SoapClient("http://www.kel12.it/RichiestaPreventivo.asmx?WSDL");
    $client = new SoapClient("http://89.34.16.229/RichiestaPreventivo.asmx?WSDL");
    $result = $client->InviaRichiestaPreventivoNew($params);
    return $result;
      
}


$nomehost = "35.214.179.94";   
$nomeuser = "myisola4_crm_app";          
$password = "Grifone71"; 
//$password = "Maresca";
$nomedb   = "myisola4_crm_app";

//Owner Person and Organization
$person_own_id = "201911071530ICNC";
$organizatione_own_id = "202009200017MC";

//&& isset($_POST['g-recaptcha-response']

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";


   
if ($_POST['request_type'] == 'business_request' ) {

    $datapartenza = 0;
    $datadaBASE = 0;
    $dataaBASE = 0;

    ///------ dati di gestione email
    $admin_email                = trim($_POST['admin_email']);
    $admin_email_subject        = trim($_POST['subject_email']);;
    $admin_email_body           = trim($_POST['body_email']);
    $admin_email_headers_from   = trim($_POST['headers_from_email']);
    $referer                    = trim($_POST['referer']);
 
    
    //$captcha=$_POST['g-recaptcha-response'];
	$ip = $_SERVER['REMOTE_ADDR'];
	//$secretkey = "6LeJ7G0UAAAAAFKq6ED1sXeqvlp3NW90zKkESrp-";					
	//$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretkey."&response=".$captcha."&remoteip=".$ip);
	//$responseKeys = json_decode($response,true);	     
    $responseKeys["success"] = 1;
	if(intval($responseKeys["success"]) !== 1) {
	    echo '<h2>Wrong captcha try again please!</h2>';
	} else {
	            	
    $PersonEmail            = trim($_POST['PersonEmail']);
    $PersonName  			= trim($_POST['PersonName']);
	$PersonSurname 			= trim($_POST['PersonSurname']);
	$PersonTel   			= trim($_POST['PersonTel']);
	
        
    $OrgName 			    = trim($_POST['OrgName']);
	$OrgCity			    = trim($_POST['OrgCity']);
    $OrgWebSite			    = trim($_POST['OrgWebSite']);
	
        
    $ReqSubjet				= $_POST['ReqSubjet'];
    //$ReqSubjet              = $business_request_Subject;
	$ReqDesc				= trim($_POST['ReqDesc']);
    $ReqProd            = trim($_POST['ReqProd']); 
    $ReqType            = trim($_POST['ReqType']);
    $ReqName            = trim($_POST['ReqName']);   
    
          
    $privacy3       = trim($_POST['privacy3']);
    $privacy2       = trim($_POST['privacy2']);
    $privacy1       = trim($_POST['privacy1']);

    $ReqDesc .= " --- Id Viaggio richiesto: " .$idViaggioKel = trim($_POST['idViaggioKel12']) . " --- ";
    $ReqDesc .= " --- Num Adulti: " .$PersonAdultNum = trim($_POST['PersonAdultNum']) . " --- ";
    $ReqDesc .= " --- Num Bambini: " .$PersonChildNum = trim($_POST['PersonChildNum']) . " --- ";
    $ReqDesc .= " --- id Partenza viaggio di gruppo: " .$iddatapartenzaBASE = trim($_POST['iddatapartenzaBASE']) . " --- ";
    $ReqDesc .= " --- Data Partenza viaggio individuale: " .$datadaBASE = trim($_POST['datadaBASE']) . " --- " ;
    $ReqDesc .= " --- Data Ritorno viaggio individuale: " .$dataaBASE = trim($_POST['dataaBASE']) . " --- " ;



    
        
    $subject_email = trim($_POST['subject_email']);
    
//    $address_geocode = $paxIndirizzo ."+" .$paxCAP."+"  .$Citta;
//    $arr_code = geocode($address_geocode);
//    $coordxy = $arr_code[0] ."," .$arr_code[1];
    //1. invio mail 
	//2. registro su base isola
	//. chiamo webService
	//2. registro su base isola
    date_default_timezone_set('Europe/Rome');
    $data_adesso = date('Ymd');
    $ora_reg = date('Hms');   
    $timestamp = date('YmdHis');
        
    $user_ip = getUserIP();
    //mi collego in remoto (my-isola che deve poter accettare!) 
    $connessione_ext = new mysqli($nomehost, $nomeuser, $password , $nomedb );
    // verifica su eventuali errori di connessione
    if ($connessione_ext->connect_errno) {
        echo "Connessione fallita rem: ". $connessione_ext->connect_error . ".";
        //////ciclo di connessioni
        ////// se tutte fallite invia mail (codice per invio mail);
        //exit();
    }else{
        //echo "Connessione riuscita rem. ";
        
        $PersonEmail            = $connessione_ext->real_escape_string($PersonEmail);
        $PersonName  			= $connessione_ext->real_escape_string($PersonName);
        $PersonSurname 			= $connessione_ext->real_escape_string($PersonSurname);
        $PersonTel   			= $connessione_ext->real_escape_string($PersonTel);

        $OrgName 			    = $connessione_ext->real_escape_string($OrgName);
        $OrgCity			    = $connessione_ext->real_escape_string($OrgCity);
        $OrgWebSite			    = $connessione_ext->real_escape_string($OrgWebSite);

        //$ReqSubjet				= $_POST['ReqSubjet'];
        $ReqSubjet              = $connessione_ext->real_escape_string($ReqSubjet);
        $ReqDesc				= $connessione_ext->real_escape_string($ReqDesc);
        $ReqProd                = $connessione_ext->real_escape_string($ReqProd); 
        $ReqType                = $connessione_ext->real_escape_string($ReqType);
        $ReqName                = $connessione_ext->real_escape_string($ReqName);
        
        $privacy3       = $connessione_ext->real_escape_string($privacy3);
        $privacy2       = $connessione_ext->real_escape_string($privacy2);
        $privacy1       = $connessione_ext->real_escape_string($privacy1);
    
         ///exit();  
        //// Looking for Person
        $sql_select = "SELECT * FROM icnc_crm_person WHERE (Email = '$PersonEmail' AND ID_Own_Person = '$person_own_id' AND ID_Own_Organization = '$organizatione_own_id' ); ";
        $result = $connessione_ext->query($sql_select);
        if ($result->num_rows > 0)
        {
             $row = $result->fetch_object();

             $unik = $row->ID;
             $sql_insert_ext = "UPDATE icnc_crm_person SET 
                Name    ='$PersonName',
                Surname ='$PersonSurname', 
                Telephone_1 ='$PersonTel',
                Priv_1 ='Y',
                Priv_2 ='Y',
                Priv_3 ='Y',
                Date_Priv_1 = '$timestamp',
                Date_Priv_2 = '$timestamp',
                Date_Priv_3 = '$timestamp',
                Updated = '$timestamp',
                Updated_By = '$person_own_id' WHERE (Email = '$PersonEmail' AND ID_Own_Person = '$person_own_id' AND ID_Own_Organization = '$organizatione_own_id' );
                "; 
            
            
        }
        else
        {
                
            $unik = date('YmdHis') .mt_rand();
            $sql_insert_ext = "INSERT INTO icnc_crm_person (ID,Name,Surname,Telephone_1,Telephone_2,Email,Web_Site,Birthday,Sex,Role_Organization,Priv_1,Date_Priv_1,Priv_2,Date_Priv_2,Priv_3,Date_Priv_3,Priv_1_Channel,Priv_2_Channel,Priv_3_Channel,ID_FK_Organization,ID_Own_Organization,ID_Own_Person,ID_Group,Created,Created_By,Updated,Updated_By ) VALUES (
'$unik','$PersonName','$PersonSurname','$PersonTel','','$PersonEmail','','','','','Y','$timestamp','Y','$timestamp','Y','$timestamp','$timestamp','$timestamp','$timestamp','$organizatione_own_id','$organizatione_own_id','$person_own_id','','$timestamp','$person_own_id','$timestamp','$person_own_id');" ;
   
        }
        //echo "<br>unik: " .$unik;       
        if ($connessione_ext->query($sql_insert_ext ) === TRUE) 
        {
            //echo "New record created successfully";
        } 
        else 
        {
            //echo "Error: " . $sql_insert_ext . "<br>" . $connessione_ext->error;
        }
        
        
        if($OrgName){
        
            $unik_org = date('YmdHis') .mt_rand();
            /////Manage info about organizatione
            $sql_select = "SELECT * FROM icnc_crm_organization WHERE (Name like '%$OrgName%' AND City = '$OrgCity' AND ID_Own_Person = '$person_own_id' AND ID_Own_Organization = '$organizatione_own_id'  ); ";

            $result = $connessione_ext->query($sql_select);

            if ($result->num_rows > 0){ 
                 $sql_insert_ext = "UPDATE icnc_crm_organization SET 
                    (Name = '$OrgName',
                    City = '$OrgCity'
                     WHERE (Name = '%$OrgName%' AND City = '$OrgCity' AND ID_Own_Person = '$person_own_id' AND ID_Own_Organization = '$organizatione_own_id'  ); ";


            }
                else
            {

                $sql_insert_ext = "INSERT INTO icnc_crm_organization (
    ID,Name,Type,VAT,CF,Legal_Form,Address,ZIP_Code,City,ID_City,State,ID_State,Nation,ID_Nation,CoordXY,Telephone_1,Telephone_2,Email,Web_Site,Person_Name,Person_Surname,ID_FK_Person,ID_FK_Organization,ID_Own_Organization,ID_Own_Person,ID_Group,Created,Created_By,Updated,Updated_By
     ) VALUES ( '$unik_org','$OrgName','Business','','','','','','$OrgCity','','','','','','','','','','$OrgWebSite','$PersonName','$PersonSurname','$unik','','','$person_own_id','','$timestamp','$person_own_id','$timestamp','$person_own_id' );" ;
            }

            //echo "<br> cosa faccio: " .$sql_insert_ext;
            if ($connessione_ext->query($sql_insert_ext ) === TRUE) {
                //echo "New address created successfully";
            } else {
                //echo "Error: " . $sql_insert_ext . "<br>" . $connessione_ext->error;
            }
            
        }
        
        $data_ora_adesso = date('YmdHis') ;
        $unik_req = date('YmdHis') .mt_rand();
        
        //echo "Classe: " .$classe;
        $sql_insert_ext = "INSERT INTO icnc_crm_business_request ( ID,Subject,Description,Product,ID_Product,Channel_Type,Channel_Name,ID_FK_Organization,ID_FK_Person,ID_Own_Organization,ID_Own_Person,ID_Group,Created,Created_By,Updated,Updated_By ) VALUES (  
'$unik_req','$ReqSubjet','$ReqDesc','$ReqProd','','$ReqType','$ReqName','$organizatione_own_id','$unik','$organizatione_own_id','$person_own_id','','$data_ora_adesso','$person_own_id','$data_ora_adesso','$person_own_id' );" ;
    
        // echo "<br>unik: " .$unik;       
        if ($connessione_ext->query($sql_insert_ext ) === TRUE) {
            //echo "New request created successfully";
        } else {
            //echo "Error: " . $sql_insert_ext . "<br>" . $connessione_ext->error;
        }
        
//        $sql_insert_ext = "INSERT INTO icnc_richiesta_X (ID_request, campo_1, campo_2, campo_3, campo_4, campo_5 ) VALUES (  '$unik_req' , '$consumo', '$costo', '$potenza', '$request_text', '$from_web_site' );" ;
//
//       // echo "<br>unik: " .$unik;       
//        if ($connessione_ext->query($sql_insert_ext ) === TRUE) {
//            echo "New request x created successfully";
//        } else {
//            echo "Error: " . $sql_insert_ext . "<br>" . $connessione_ext->error;
//        }
 
        mysqli_close($connessione_ext);
    }
    
   
	//2. registro su base isola -FINE

    /// Registro su klsgp utente (anche se è già registrato)
    $idnazinefittizio = 2;
    
    if (!isset($params)):
        $params = new stdClass();
    endif;	
    $params1->email 		= $PersonEmail;
    $params1->nome 			= $PersonName;
    $params1->cognome 		= $PersonSurname;
    $params1->idCitta 		= '';

    $params1->newsletter 	= 1;    	//= $paxNL;
    $params1->telefono ='';
    $params1->idNazione = $idnazinefittizio;
    $params1->indirizzo ='';
    $params1->cap ='';
    $params1->idProvincia ='';
    $params1->daSito 					= 'LEVI';           
    $params1->errorMessage   = '';

    $params1->TagRegistrazione = '';
    $params1->DataTagRegistrazione = '';
    $client1 = new SoapClient("http://89.34.16.229/RichiestaPreventivo.asmx?WSDL");
    $result1 = $client1->RegistrazionePaxNew($params1)->RegistrazionePaxNewResult;

    $reg_ok = 0;
    if ($result1){ 
        $reg_ok = 1;
    }
    else
    {
        //nn ha registrato mando a booking email di sicurezza
        //INVIO EMAIL A BOOKING DICENDO CHE REGISTRAZIONE AUTOMATICA NON HA FUNZIONATO -- NON SI PERDE RICHIESTA!
        $err_req_prev = "ERR_REGISTRAZIONE_UTENTE";
        //mailtobooking ($emailBASE, $idKelviaggioBASE, $datadaBASE, $dataaBASE, $iddatapartenzaBASE , $NumAdultiBASE,$NumBambiniBASE,$UlterioriRichiesteBASE,$result,$myObj->errreqprev,$callws,$datierrati,$nomeREG,$cognomeREG);
        //echo "Ciaoooo" ;
    }

    if ($reg_ok)
    {
        //entro solo se registrazione andata a buon fine
        //echo "tutto bene";

    }
    
    $NumAdulti = $PersonAdultNum;
    $NumBambini = $PersonChildNum;
    $UlterioriRichieste =  $ReqDesc ;
    $datapartenza = $iddatapartenzaBASE;

    if($NumAdulti > 0){ //uso num adulti perchè se qualcuno fa richiesta di preventivo... deve sceglierlo

        if($datapartenza){
            $result_arr = richiedi_preventivo_ws1 ($PersonEmail,$idViaggioKel,$NumAdulti,$NumBambini,$UlterioriRichieste,$datapartenza );
            
            $result = $result_arr->RegistrazioneRichiestaNewResult;

            $errorMessage = $result_arr->errore;
            if ($result == 1){ ///result è true  
                //echo " ancora bene";
            }
            else 
            {
                $reqprev = 0;
                echo $err_reqprev = "ERR_RICHIESTA_PREVENTIVO_VIAGGIO_GRUPPO: ".$errorMessage; 
                //mailtobooking ($emailBASE, $idKelviaggioBASE, $datadaBASE, $dataaBASE, $iddatapartenzaBASE , $NumAdultiBASE,$NumBambiniBASE,$UlterioriRichiesteBASE,$result,$myObj->errreqprev,$callws,$datierrati,$nomeREG,$cognomeREG);
            }
        }

        if($datadaBASE){

            $descrizioneViaggio = " ";

            $result_arr = richiedi_preventivo_ws2 ($PersonEmail,$idViaggioKel,$NumAdulti,$NumBambini,$UlterioriRichieste,$datadaBASE, $dataaBASE, $descrizioneViaggio );
            
            $result = $result_arr->InviaRichiestaPreventivoNewResult;
            $errorMessage = $result_arr->errore;
            
            if ($result == 1){ ///result è true  
                //echo " ancora bene";
            }
            else 
            {
                $req_prev = 0;
                
                echo $err_req_prev = "ERR_RICHIESTA_PREVENTIVO_VIAGGIO_INDIVIDUALE: ".$errorMessage;
                //mailtobooking ($emailBASE, $idKelviaggioBASE, $datadaBASE, $dataaBASE, $iddatapartenzaBASE , $NumAdultiBASE,$NumBambiniBASE,$UlterioriRichiesteBASE,$result,$myObj->errreqprev,$callws,$datierrati,$nomeREG,$cognomeREG);
            
            }
            
        }
    }
    /////invio mail 
    /// Prepare eMail to send to customer and to admin
    //mail to customer
        
    $to = $PersonEmail;
    $nome_dem = $PersonName  . " " . $PersonSurname;
    $body = "Grazie " .$nome_dem .","; 
    $body .= "<br>Per averci richiesto maggiorni informazioni su " .$ReqSubjet ;
    $body .= "<br>Ti contatteremo nel più breve tempo possibile per fornirti tutte le informazioni.";
    $body .= "<br><br> Grazie dal Team di Villa La Bianca! ";
    $body .= "<br><br> <a href='https://villalabianca.it/'>TI ASPETTIAMO A VILLA LA BIANCA!</a>";

    $headers[] = 'From: ' .$admin_email_headers_from;
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    //$headers[] = 'Bcc: rickygrassi@gmail.com';
    $headers_mail = implode("\r\n", $headers);
        
    //mail to admin
    $to_admin       = $admin_email;
    $body_admin   = $admin_email_body;        
    $body_admin  .= "Nuova Richiesta da:<br><br>Nome Cognome: " .$nome_dem ;
    $body_admin  .= "<br>Email: " .$PersonEmail ;
    $body_admin  .= "<br>Tel: " .$PersonTel ;
    $body_admin  .= "<br>Oggetto: " .$ReqSubjet ;
    $body_admin  .= "<br>Descrizione: " .$ReqDesc ;
             
    // require 'vendor/PHPMailer/src/Exception.php';
    // require 'vendor/PHPMailer/src/PHPMailer.php';
    // require 'vendor/PHPMailer/src/SMTP.php'; 

    // function sm_send_mail($to, $subject, $body, $admin_email_headers_from)
    //     {
    //     $mail = new PHPMailer(true) ;
    //     $mail->isSMTP() ;
    //     $mail->Host = "smtp.office365.com" ;
    //     $mail->Username = "booking-web@villalabianca.com";
    //     $mail->Password = "Pac64797";
    //     $mail->Port = 587;
    //     $mail->SMTPSecure = 'tls';
    //     $mail->SMTPAuth = true;

    //     $mail->setFrom("booking-web@villalabianca.com", "TEMP LEVI");
    //     $mail->addBcc("rickygrassi@gmail.com");
    //     //$mail->addBcc("stefano.murrau@gmail.com");
    //     $mail->addAddress($to) ;
      
    //     $mail->IsHTML(true);

    //     $mail->Subject = $subject;
    //     $mail->Body = $body;
   
    //     $mail->send() ; 
    //     }
    // //mail( $to, $subject, $body_admin, $headers ); 
    // //wp_mail( 'relais@villalabianca.com', $subject, $body, $headers );
    // if( sm_send_mail( $to, $admin_email_subject, $body, $admin_email_headers_from ))
	// 	{
    //     //echo "inviata";
		
	// 	}
	// else
	// 	{
    //     //echo "Non inviata";
		
	// 	}

    // if( sm_send_mail( $to_admin, $admin_email_subject, $body_admin, $admin_email_headers_from ))
	// 	{
    //     //echo "inviata admin";
		
	// 	}
	// else
	// 	{
    //     //echo "non inviata admin";
		
	// 	}
        
      //echo "fine";
    
    $_SESSION['business_request'] = 'Y';
  //  header("location: " .$referer);

    if (!empty($_SERVER['HTTP_REFERER']))
        header("Location: ".$_SERVER['HTTP_REFERER']);
    else
        header("location: " .$referer);;
    exit;

}
}else {
    echo "non sono entrato qui... ";
}
