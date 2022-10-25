<?php 

    session_start() ;

    $website = $_SERVER['SERVER_NAME'] ;  
    $page = $_SERVER['REQUEST_URI'] ;


    // Business Request
    $business_request_Subject = "Iscrizione Newsletter i viaggi di Maurizio Levi" ;
    $business_request_Desc = "Richiesta iscrizione Newsletter i viaggi di Maurizio Levi" ;
    $business_request_Product = $page ;
    $business_request_Channel_Type = "web" ;
    $business_request_Channel_Name = $website ;


    // Prepare default data to insert in to varous table --> to modify in every site this code will be inserted 
    $admin_email = 'info@viaggilevi.com' ;
    $admin_email_subject  = 'Richiesta iscrizione NewsLetter Maurizio Levi' ;
    $admin_email_body = "" ;
    $admin_email_headers_from = "Richiesta iscrizione NewsLetter <info@viaggilevi.com>" ;


    $action = "/assets/mc_request_exe_ml.php" ;
    $referer = base_url() ; 

?>

<!-- NEWSLETTER START //-->
<section id="newsletter">
    <div class="container-fluid">
        <form id="request" name="business_request" method="post" action="<?php echo $action; ?>">

            <div class="row g-0">
                <div class="text-center">
                    <h4 class="title mb-4">NEWSLETTER</h4>
                    <p class="mb-4">Resta <span class="accent">aggiornato</span> e ricevi <br /> le nostre comunicazioni sui viaggi,<br /> sulle promozioni e sulle numerose novità</p>
                </div>
                <div class="row wrap-input">
                    <div class="col-12 col-sm-12 col-md-6 mb-3">
                        <input type="text" class="levi-input form-control" placeholder="Nome (necessario)"  name="PersonName" id="PersonName" value="" required  >
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 mb-3">
                        <input type="text" class="levi-input form-control" placeholder="Cognome (necessario)" name="PersonSurname" id="PersonSurname" value="" required >
                    </div>
                    <div class="col-12 col-sm-12 mb-4">
                        <input type="email" class="levi-input form-control" placeholder="E-mail (necessario)" name="PersonEmail" id="PersonEmail" value=""  required >
                    </div>
                    <div class="col-12 col-sm-12 form-check mb-3">
                        <input type="checkbox" class="form-check-input privacy" id="privacy_1" name="privacy1" required >
                        <label class="levi-label" for="privacy_1">
                            Ho preso visione dell'<a href="/informativa-privacy-e-cookie.php" target="_blank">informativa sulla privacy</a> e presto il consenso a Kel 12 Tour Operator S.r.l. per il trattamento dei miei dati personali.*
                        </label>
                    </div>
                    <div class="col-12 col-sm-12 form-check mb-3">
                        <input type="checkbox" class="form-check-input privacy" id="privacy_2" name="privacy2" required>
                        <label class="levi-label" for="privacy_2">
                            Presto il consenso al trattamento dei miei dati personali per l'invio tramite sms e/o e-mail di comunicazioni informative e promozionali.*
                        </label>
                    </div>
                    <div class="col-12 col-sm-12 form-check mb-4">
                        <input type="checkbox" class="form-check-input privacy" id="privacy_3" name="privacy3" required>
                        <label class="levi-label" for="privacy_3">
                            Presto il consenso al trattamento dei miei dati personali per l’iscrizione al servizio di invio newsletter in relazione alle iniziative proprie e/o di società controllate e/o collegate, nonché del nostro partner ufficiale National Geographic Partners LLC.*
                        </label>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="levi-primary-btn">Registrati</button>
            </div>

            <input type="hidden" name="admin_email" value="<?php echo $admin_email; ?>" />
            <input type="hidden" name="subject_email" value="<?php echo $subject_email; ?>" />
            <input type="hidden" name="body_email" value="<?php echo $body_email; ?>" />
            <input type="hidden" name="headers_from_email" value="<?php echo $headers_from_email; ?>" />
            <input type="hidden" name="referer" value="<?php echo $referer; ?>" />
            <input type="hidden" name="request_type" value="business_request" />
            <input type="hidden" name="PersonTel" id="PersonTel" value="" />
            <input type="hidden" name="PersonCountry" id="PersonCountry" value="" />
            
            <input type="hidden" name="OrgName" id="OrgName" value="" />
            <input type="hidden" name="OrgCity" id="OrgCity" value="" />
            <input type="hidden" name="OrgWebSite" id="OrgWebSite" value="" />
         
            <?php  

                $endDate = date('Y-m-d', strtotime('+3 days')) ;
                $minDate = date('Y-m-d', strtotime('+1 days')) ;

            ?>

            <input type="hidden" name="ReqSubjet" id="ReqSubjet" value="<?php echo $business_request_Subject; ?>" />
            <input type="hidden" name="ReqProd" id="ReqProd" value="<?php echo $business_request_Product; ?>" />
            <input type="hidden" name="ReqType" id="ReqType" value="<?php echo $business_request_Channel_Type; ?>" />
            <input type="hidden" name="ReqName" id="ReqName" value="<?php echo $business_request_Channel_Name; ?>" />  
           
        </form>
    </div>
</section>
<!-- NEWSLETTER END //-->