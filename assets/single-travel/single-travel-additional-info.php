<?php 

    $id_viaggio = $_GET['id'] ;
    $base_url = base_url() ;
    

    function mc_apicall_viaggio_tl($id_tl)
        {
        
        $URL = "https://klsgp.kel12.it" ;
        $ENDPOINT = "/api/Anagrafiche/TourLeader" ;

        $textToEncrypt = strftime("%Y%m%d%H%M%S") ;
        $encryptionMethod = "AES-256-CBC" ;
        $secretHash = "Kel12VLB2022" ;

        $token = openssl_encrypt($textToEncrypt, $encryptionMethod, $secretHash) ;

        $postRequest = array(
            "idKelTourLeader" => $id_tl,
            "token" => $token
            ) ;

        $curl = curl_init() ;
        curl_setopt($curl, CURLOPT_URL, $URL . $ENDPOINT) ;
        curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($postRequest)) ;
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
    $viaggio_partenze= mc_apicall_viaggio_partenze($id_viaggio ) ;		
  
    $ii = 0 ;

    $idKelTourLeader = array() ;

    foreach( $viaggio_partenze['response'] as $k=>$partenza )
        {
        if( strlen($partenza['idKelTourLeader']) > 0 )
            {
            if( in_array($partenza['idKelTourLeader'], $idKelTourLeader) )
                {
            
                }
            else
                {
                $idKelTourLeader[] = $partenza['idKelTourLeader'] ;
                $data_partenza[] = $partenza['dataPartenza'] ;
                }
            } 

        $ii = $ii + 1;
        }
 ?>


    <!-- Choosing Us START -->
    <section id="choosing-us" class="choosing-us">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 wrap-component-1">
                    <div>
                        <h2 class="title">Perché <span class="fst-italic">Noi</span></h2>
                    </div>
                    <div class="py-4 mx-3">
                        <?php echo $viaggio_klsgp['response'][0]['comeSiViaggia'] ; ?>
                    </div>

                </div>

                <div class="col-12 col-sm-12 col-md-6 wrap-component-2">
                    <div class="mb-4">
                        <h2 class="title">I nostri <span class="fst-italic">Esperti</span></h2>
                    </div>
                    <div class="owl-carousel owl-theme">

                    <?php 

                        $aaa = 0 ;
                        foreach( $idKelTourLeader as $key => $value )
                            {
                            $arr_tl = mc_apicall_viaggio_tl($value) ;

                    ?>
                    
                        <div class="item">
                            <div class="card rounded-0 card1" style="background-repeat: no-repeat; background-size: cover; background-image:url(<?php echo $arr_tl['response'][0]['immagine'] ; ?>);">
                                <div class="card-img-overlay d-flex">
                                    <div class="mt-auto">
                                        <h6 class="fw-light"><?php echo $arr_tl['response'][0]['tipologia'] ; ?></h6>
                                        <h6 class="text-uppercase"><?php echo $arr_tl['response'][0]['nomeTourLeader'] ; ?>&nbsp;<?php echo $arr_tl['response'][0]['cognomeTourLeader'] ; ?></h6>
                                        <p class="text-uppercase">Prossima partenza:</p>

                                        <?php 

                                            $data_str = substr($data_partenza[$key],0,10) ;
                                            $date=date_create($data_str) ;

                                        ?>
                                        
                                        <p><?php echo date_format($date,"d M Y") ; ?></p>

                                        <a href="<?php echo $base_url;?>/tour-leaders-single.php?id=<?php echo $arr_tl['response'][0]['idKelTourLeader'] ; ?>" > 
                                            <button class="levi-secondary-btn">Scopri di più</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php 

                            $aaa = $aaa + 1 ;
                            }

                        if(!$aaa) 
                            {

                    ?>

                        <div class="item">
                            <div class="card rounded-0 card1" style="background-image:url(../img/levi-logo.svg);">
                                <div class="card-img-overlay d-flex">
                                    <div class="mt-auto">
                                        <h6 class="fw-light"><?php echo $arr_tl['response'][0]['tipologia'];?></h6>
                                        <h6 class="text-uppercase"><?php echo $arr_tl['response'][0]['nomeTourLeader'];?>&nbsp;<?php echo $arr_tl['response'][0]['cognomeTourLeader'];?></h6>
                                        <p class="text-uppercase">Prossima partenza:</p>

                    <?php 
                                    
                            $data_str = substr($data_partenza[$key],0,10) ;
                            $date=date_create($data_str) ;
                                    
                    ?>
                                    
                                        <p><?php echo date_format($date,"d M Y"); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php 

                        }

                    ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Choosing Us END -->  
