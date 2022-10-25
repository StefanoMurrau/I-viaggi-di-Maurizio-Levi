<?php 

    //prendo tutti i dati della pagina su cui sono: 
    $sitoweb = $_SERVER['SERVER_NAME'];  
    $pagina = $_SERVER['REQUEST_URI'];

    //Business Request
    $business_request_Subject = "Richiesta informazioni i Viaggi di Maurizio Levi";
    $business_request_Desc = "Richiesta informazioni i Viaggi di Maurizio Levi";
    $business_request_Product = $pagina;
    $business_request_Channel_Type = "web";
    $business_request_Channel_Name = $sitoweb;

    //email
    $admin_email = 'info@viaggilevi.com' ;
    $admin_email_subject  = 'Richiesta informazioni i Viaggi di Maurizio Levi' ;
    $admin_email_body = "" ;
    $admin_email_headers_from = "Richiesta informazioni i Viaggi di Maurizio Levi <info@viaggilevi.com>" ;


    $action = "/assets/mc_request_exe_ml.php" ;
    $referer = base_url();

    $data = mc_middleware_call( constant("MIDDLEWARE_BASE_URL"), "contact-us-content", "levi") ;
?>

        <!-- Contatti START -->
        <section id="contatti" class="contatti-section" style="padding-top:120px;">
            <div class="contatti-image-1">
                <div class="container  wrap-contatti p-xl-5 p-3">
                    <div class="row g-0">
                        <div class="col-lg-6 col-md-12 col-sm-12 order-2 order-md-1">

                            <div class="card contatti-card rounded-0 border-0 p-5">
                                <div class="card-body">
                                    <h2 class="card-title">Contattaci</h2>
                                        <ul class="py-5">
                                            <li>
                                                <p>
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <span class="contatti-span"> Indirizzo: </span> 
                                                    <a class="contatti-href" target=”_blank” href="https://www.google.com/maps/place/Via+Francesco+Londonio,+4,+20154+Milano+MI/@45.479064,9.1686848,17z/data=!3m1!4b1!4m5!3m4!1s0x4786c13f5294155b:0x3a5518c9a0f31ba!8m2!3d45.479064!4d9.1708735"> Via Londonio, 4 – 20154 MILANO </a>
                                                </p>
                                            </li>
                                            <li>
                                                <p> 
                                                    <i class="fas fa-phone"></i>
                                                    <span class="contatti-span"> Tel: </span> 
                                                    <a class="contatti-href" target="_blank" href="tel:+39 0234934528"> +39 0234934528</a> – <a class="contatti-href" target="_blank" href="tel:+39 0228181122"> +39 0228181122 </a>
                                                </p>
                                            </li>
                                            <li>
                                                <p> 
                                                    <i class="fas fa-paper-plane"></i>
                                                    <span class="contatti-span"> E-mail: </span> 
                                                    <a class="contatti-href" target=”_blank” href="mailto:abc@example.com">info@viaggilevi.com</a>
                                                </p>
                                            </li>
                                            <li>
                                                <p>
                                                    <i class="fas fa-paper-plane"></i>
                                                    <span class="contatti-span"> Ufficio Stampa: </span>
                                                    <a class="contatti-href" target=”_blank” href="mailto:abc@example.com">comunicazione@viaggilevi.com </a>
                                                </p>
                                            </li>
                                            <li>
                                                <p>
                                                    <i class="fas fa-globe"></i>
                                                    <span class="contatti-span"> Sito Web: </span> <a class="contatti-href" target=”_blank” href="https://www.viaggilevi.com">https://www.viaggilevi.com</a>
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 col-sm-12 order-1 order-md-2">
                                <div class="card rounded-0 border-1 p-5 ">
                                    <div class="card-body">
                                        <div class="">
                                            <h2 class="card-title">Entra in contatto</h2>
                                        </div>

                                        <form id="request" name="business_request" method="post" action="<?php echo $action; ?>">
                                            <div class="row wrap-input">
                                                <div class="col-12 col-xxl-6 mt-3">
                                                    <input type="text" class="levi-input form-control" placeholder="Nome*" name="PersonName" id="PersonName" value="" required>
                                                </div>
                                                <div class="col-12 col-xxl-6 mt-xxl-3">
                                                    <input type="text" class="levi-input form-control" placeholder="Cognome*" name="PersonSurname" id="PersonSurname" value="" required>
                                                </div>
                                                <div class="col-12 col-xxl-6">
                                                    <input type="email" class="levi-input form-control" placeholder="E-mail*" name="PersonEmail" id="PersonEmail" value=""  required>
                                                </div>
                                                <div class="col-12 col-xxl-6">
                                                    <input type="text" class="levi-input form-control" placeholder="Telefono" name="PersonTel" id="PersonTel" value="" >
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <textarea type="text" rows="3" class="levi-input form-control" placeholder="Lascia il tuo messaggio*" required name="ReqDesc"></textarea>
                                                </div>

                                                <div class="col-12 col-sm-12 checkboxes mb-3">
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
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="levi-primary-btn">Invia</button>
                                                </div>
                                                <div class="diamond"></div>
                                            </div>

                                            <!--- Area Person -->
                                            <input type="hidden" name="admin_email" value="<?php echo $admin_email; ?>" />
                                            <input type="hidden" name="subject_email" value="<?php echo $admin_email_subject; ?>" />
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

                                            <?php  

                                                $endDate = date('Y-m-d', strtotime('+3 days'));
                                                $minDate = date('Y-m-d', strtotime('+1 days'));
                                            
                                            ?>

                                            <!--- Area Request -->
                                            <input type="hidden" name="ReqSubjet" id="ReqSubjet" value="<?php echo $business_request_Subject; ?>" />
                                            <input type="hidden" name="ReqProd" id="ReqProd" value="<?php echo $business_request_Product; ?>" />
                                            <input type="hidden" name="ReqType" id="ReqType" value="<?php echo $business_request_Channel_Type; ?>" />
                                            <input type="hidden" name="ReqName" id="ReqName" value="<?php echo $business_request_Channel_Name; ?>" />  
                                        </form>

                                    </div>     
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <div class="levi-i-frame text-center">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2797.540277281038!2d9.168684815338056!3d45.47906397910112!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4786c13f5294155b%3A0x3a5518c9a0f31ba!2sVia%20Francesco%20Londonio%2C%204%2C%2020154%20Milano%20MI!5e0!3m2!1sit!2sit!4v1655712294907!5m2!1sit!2sit" width="100%" height="450" style="border:0 ; margin-bottom:-5px ;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            
        </section>
        <!-- CONTENT END //-->