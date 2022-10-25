<?php

    $id_viaggio = $_GET['id'] ;
    $data = mc_apicall_viaggio($id_viaggio) ;

    $content = $data['response'][0]['testoPerSito'] ;
  
    //------------------------------------------------------------------------------------
    // gestione day by day per mappa

    $viaggio_daybyday = mc_apicall_daybyday($id_viaggio ) ;
    $myurl = base_url();
    $ii = 0 ;

    foreach( $viaggio_daybyday['response'] as $k=>$viaggio_giorno )
        {
        $id[$k]= $viaggio_giorno['idViaggioKel'] ;
        $giorno[$k] = $viaggio_giorno['giorno'] ;
        }
        
    array_multisort( $giorno,SORT_ASC,SORT_NUMERIC, $viaggio_daybyday['response'] ) ;

    $lat            =array() ;
    $lon            =array() ;
    $day_itin       =array() ;
    $descr          =array() ;
    $descr_long     =array() ;
    $descr_short    =array() ;

    $tappa_itin     =array() ;
    $tappa          =array() ;

    $z = 0;

    foreach($viaggio_daybyday['response'] as $key => $rowday)
        {
        if(strlen($rowday['coordinateXy'])>0)
            {
            $coordxy = explode(",", $rowday['coordinateXy']);
       
            $lat[$z]        = preg_replace('/[^\d\-\.]+/i', '',$coordxy[0]) ;
            $lon[$z]        = preg_replace('/[^\d\-\.]+/i', '',$coordxy[1]) ;

            $day_itin[$z]   = $rowday['giorno'] ;
            $tappa_itin[$z] = $rowday['tappa'] ;

            $descr[$z]      = mb_convert_encoding(strip_tags($rowday['descrizioneBreve']), 'UTF-8', 'Windows-1252') ;
            $descr_short[$z]= mb_convert_encoding(strip_tags($rowday['descrizioneBreve']), 'UTF-8', 'Windows-1252') ;
            $descr_long[$z] = mb_convert_encoding(strip_tags($rowday[4]), 'UTF-8', 'Windows-1252') ;
            
            $tappa[$z] = str_replace(',', ' ', $descr[$z]) ;

            $z=$z+1 ;
            }
        }

    if( count($lat) > 1 and count($lon) > 1 )
        {
        $max_lat = max($lat) ;
        $min_lat = min($lat) ;
        $max_lon = max($lon) ;
        $min_lon = min($lon) ;
        }

    if( count($lat) == 1 or count($lon) == 1 )
        {
        $max_lat=$lat[0] ;
        $min_lat=$lat[0] ;
        $max_lon=$lon[0] ;
        $min_lon=$lon[0] ;
        }

    $media_lat = ($max_lat + $min_lat) / 2 ;
    $media_lon = ($max_lon + $min_lon) / 2 ;

    $str_lat = trim(implode(",",$lat)) ;
    $str_lon = trim(implode(",",$lon)) ;
    $str_tappa = implode(",",$tappa) ;
    $lat_c = trim($media_lat) ; 
    $lon_c = trim($media_lon) ;  

    $zoom = 8 ; 
    $map_title = "" ;
    $map_tooltip = "" ;

    //------------------------------------------------------------------------------------

?>

    <!-- INFO START //-->
    <section id="single-info">
        <div class="container">
            <div class="row g-2">
                <div class="col-12 col-sm-12 col-md-6 mb-3">
                    <div id="gmap"></div>
                </div>  

                <div id="table" class="table-responsive col-12 col-sm-12 col-md-6 mb-3" style="padding-left: 50px !important ;">
                    <table class="table align-middle w-100" style="padding-left: 50px !important ;">
                        <thead>
                            <tr>
                                <td style="border-color: #a06b1b ;"><h5>DURATA</h5></td>
                                <!-- <td style="border-color: #a06b1b ;"></td> -->
                                <td style="border-color: #a06b1b ;"><h5>PARTECIPANTI</h5></td>                      
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border-bottom: none ;"><?php echo $data["response"][0]['durata'] ; ?> Giorni (<?php echo $data["response"][0]['notti'] ; ?> Notti)</td>
                                <!-- <td style="border-bottom: none ;"></td> -->
                                <td style="border-bottom: none ;">Minimo: <?php echo $data["response"][0]['nrPax'] ; ?> / Massimo: <?php echo $data["response"][0]['nrPaxMassimo'] ; ?></td>
                            </tr>
                        </tbody> 
                    </table>
                        
                        <?php 

                            if( $data["response"][0]['codCategoria'] == "G" )
                                {

                        ?>

                    <table class="table align-middle w-100" style="margin-top: 60px ;">
                            <thead>
                                <tr>
                                    <!-- <td style="border-color: #a06b1b ;"><h5></h5></td> -->
                                    <td style="border-color: #a06b1b ;"><h5>DATA PARTENZA</h5></td>    
                                    <td style="border-color: #a06b1b ;"><h5>LA PARTENZA E'</h5></td>                      
                                </tr>
                            </thead>

                        <?php
                
                                $viaggio_partenze = mc_apicall_viaggio_partenze($id_viaggio ) ;
                                    
                                $ii = 0 ;
                                foreach( $viaggio_partenze['response'] as $k=>$partenza )
                                    {
                                    $id[$k]= $partenza['idViaggioKel'] ;
                                    $datapartenza[$k] = $partenza['dataPartenza'] ;
                                    }
                                    
                                array_multisort($datapartenza,SORT_ASC,SORT_NUMERIC, $viaggio_partenze['response'] ) ;
                            

                                foreach( $viaggio_partenze["response"] as $v)
                                    {
                        
                        ?>
                            
                                <tbody>
                                    <tr>
                                        <!-- <td style="border-bottom: none ;"></td> -->
                                        <td style="border-bottom: none ;"><?php echo substr( $v['dataPartenza'], 8, 2) . " " . ucfirst($v['mese']) ; ?></td>
                                        <td style="border-bottom: none ;"><span style="color: #a06b1b ;"><?php echo ucfirst($v['status']) ; ?></span></td>
                                    </tr>

                        <?php

                                    }
                                }
                            else
                                {
                        ?>

                        <thead>
                            <tr>
                                <td style="border-color: #a06b1b ;"><h5>VALIDIT&Agrave;</h5></td>
                                <td style="border-color: #a06b1b ;"><h5>PARTENZA</h5></td>    
                                <td style="border-color: #a06b1b ;"><h5>RIENTRO</h5></td>                      
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td style="border-bottom: none ;"></td>
                                    <td style="border-bottom: none ;">Dal <?php echo substr( $data["response"][0]['validitaDa'], 5 ,5) ?></td>
                                    <td style="border-bottom: none ;">Al <?php echo substr( $data["response"][0]['validitaA'], 5 ,5) ?></td>
                                </tr>
        
                        <?php
                                }
                        ?>
                    
                        </tbody>
                    </table>
                    <table class="table align-middle w-100" style="margin-top: 60px ;">    
                        <thead>
                            <tr>
                                <td style="border-color: #a06b1b ;" colspan="3"><h5>PREZZI A PARTIRE DA:</h5></td>
                                <td style="border-color: #a06b1b ;"></td>  
                                <td style="border-color: #a06b1b ;"></td>                          
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $price_children = "";
                        if ($data["response"][0]['prezzoChild'] > 0 ){
                            $price_children =  "<span style='color: #a06b1b ;'>Quota bambini</span><br/>" . $data["response"][0]['prezzoChild'] ." €";
                        } 
                       
                        $price_base2 = "";
                        if ($data["response"][0]['prezzo2'] > 0 ){
                            $price_base2  =  "<span style='color: #a06b1b ;'>Quota base per 2 persone</span><br/>" . $data["response"][0]['prezzo2'] ." €";;
                        } 
                        
                        $price_base4 = "";
                        if ($data["response"][0]['prezzo4'] > 0 ){
                            $price_base4  =  "<span style='color: #a06b1b ;'>Quota base per 4 persone</span><br/>" . $data["response"][0]['prezzo2'] ." €";;
                        } 
                        ?>
                        

                        <tr>
                            <td style="border-bottom: none ;"><span style="color: #a06b1b ;">Quota base individuale</span> <br/> <?php echo $data["response"][0]['prezzo'] ; ?> €</td>
                            <td style="border-bottom: none ;"></td>    
                            <td style="border-bottom: none ;"><?php echo $price_children ; ?></td>
                        </tr>
                        <tr>
                            <td style="border-bottom: none ;"><?php echo $price_base2; ?></td>
                            <td style="border-bottom: none ;"></td>      
                            <td style="border-bottom: none ;"><?php echo $price_base4; ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div> 

                <div id="content" class="col-12 mt-4">

                    <?php

                        $limit = 600 ;
                        if(strlen($content) >= $limit) 
                            {
                            $content_s = wordwrap($content, $limit);
                            $content_s = substr($content_s, 0, strpos($content_s, "\n"));
                            echo "<input type='hidden' name='content-short' id='content-short' value='" . strip_tags($content_s) . "' />" ;
                            echo "<input type='hidden' name='content-long' id='content-long' value='" . strip_tags($content) . "' />" ;
                            echo "<div style='font-size: calc(1rem + 0.2vw); color: #3A2F26; column-count: 2; column-gap: 30px;' id='zzz'>" . $content_s . "</div>" ;
                            echo '<i class="fas fa-angle-double-down" id="more-content-down" style="margin: auto; text-align: center; width: 100%; padding-top: 20px;cursor: pointer;"></i>' ;
                            echo '<i class="fas fa-angle-double-up" id="more-content-up" style="margin: auto; text-align: center; width: 100%; padding-top: 20px;cursor: pointer; display: none;"></i>' ;
                            }
                        else
                            {
                            echo "<div style='font-size: calc(1rem + 0.2vw); color: #3A2F26; column-count: 2; column-gap: 30px;'>" . $content . "</div>" ;
                            }

                    ?>

                </div>


            </div>


            <div class="row g-2">
                <div class="col-12 col-sm-12 col-md-12 mb-12">
                    
                    <div id="content" class=mt-4>

                        <?php
                            
                            echo "<div class='short' style='font-size: calc(1rem + 0.2vw); color: #3A2F26;'>" ;

                                if(strlen($content) > $your_desired_width) 
                                    {


                                    //caratteri massimi
                                    $max_length = 150;
                                    //comando
                                    echo  $nuova_stringa = preg_replace('/\s+?(\S+)?$/', '', mb_substr($long_string, 0, $max_length));

                                    ///echo $content_s = wordwrap($content, $your_desired_width);
                                    //$content_s = substr($content_s, 0, strpos($content_s, "\n"));
                                    //echo strip_tags($content_s) . " <span id='expand-content'>[...]</span>" ;
                                    //echo $content . " <span id='expand-content'>[...]</span>" ;
                                    //echo strip_tags($content) ;
                                    }
                                else
                                    {
                                    echo strip_tags($content) ;
                                    }

                            echo "</div>" ;
                            /* echo "<div class='long'>" ;
                            echo strip_tags($content) . " <span id='expand-content'> ^ </span>" ;
                            echo "</div>" ; */

                        ?>
    
                    </div> 
                </div>  






        </div>
    </section>
    <!-- INFO END //-->

<script type="text/javascript">

    function initMap()
        {
        //======PC========//
        var str_lat = <?php echo json_encode($str_lat); ?> ;
        lat = str_lat.split(',') ;
        var str_lon = <?php echo json_encode($str_lon); ?> ;
        lon = str_lon.split(',') ;
        var str_tappa = <?php echo json_encode($str_tappa); ?> ;
        tappa = str_tappa.split(',') ;
        var str_contentString = <?php echo json_encode($str_tappa); ?> ;
        contentString = str_contentString.split(',') ;
        //======PC========//

        var latlng = new google.maps.LatLng(<?php echo $lat_c; ?>, <?php echo $lon_c; ?>) ; // centro della mappa  by PC

        // definizione della mappa
        var myOptions = {
            zoom: 8,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.TERRAIN,
            styles	: 
                    [
                        {
                            "featureType": "water",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#e9e9e9"
                                },
                                {
                                    "lightness": 17
                                }
                            ]
                        },
                        {
                            "featureType": "landscape",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#f5f5f5"
                                },
                                {
                                    "lightness": 20
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 17
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 29
                                },
                                {
                                    "weight": 0.2
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 18
                                }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 16
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#f5f5f5"
                                },
                                {
                                    "lightness": 21
                                }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#dedede"
                                },
                                {
                                    "lightness": 21
                                }
                            ]
                        },
                        {
                            "elementType": "labels.text.stroke",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "lightness": 16
                                }
                            ]
                        },
                        {
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "saturation": 36
                                },
                                {
                                    "color": "#333333"
                                },
                                {
                                    "lightness": 40
                                }
                            ]
                        },
                        {
                            "elementType": "labels.icon",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#f2f2f2"
                                },
                                {
                                    "lightness": 19
                                }
                            ]
                        },
                        {
                            "featureType": "administrative",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "color": "#fefefe"
                                },
                                {
                                    "lightness": 20
                                }
                            ]
                        },
                        {
                            "featureType": "administrative",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "color": "#fefefe"
                                },
                                {
                                    "lightness": 17
                                },
                                {
                                    "weight": 1.2
                                }
                            ]
                        }
                    ]

            };

        var bounds = new google.maps.LatLngBounds() ;
        var infowindow = new google.maps.InfoWindow() ;

        var map = new google.maps.Map(document.getElementById("gmap"), myOptions) ;

        var i;

        var userCoor = [tappa,lat,lon] ; 
        var x,y ;
        var userCoorPath ;

        for(x=0; x < lat.length - 1 ;x++)
            {   
            var userCoorPath = new Array(new google.maps.LatLng(lat[x],lon[x]),new google.maps.LatLng(lat[x+1],lon[x+1]));
            var userCoordinate = new google.maps.Polyline({
                path: userCoorPath,
                strokeColor: "#e0c9aa",
                strokeOpacity: 2,
                strokeWeight: 2
                }) ;

            userCoordinate.setMap(map) ;
            }

        var infowindow = new google.maps.InfoWindow() ;

        var j= 0 ;
        for( i=0; i < lat.length; i++ ) 
            {
            var infowindow = new google.maps.InfoWindow({
                content: contentString[i] 
                }) ;

            var marker = new google.maps.Marker({
                icon:"<?php echo $myurl.'/img/pointer_map.png';?>",
                position:  new google.maps.LatLng(lat[i], lon[i]),
                map: map,
                labelContent: ""+i,
                title: tappa[i],
                info: contentString[i],
                label: {
                    text: ""+(i+1),
                    color: 'white',
                    fontSize: "16px",
                    fontWeight: "bold"
                    }
                }) ;

            bounds.extend(marker.position) ;

            google.maps.event.addListener( marker, 'click', function(){
                infowindow.setContent(this.info) ;
                infowindow.open(map,this) ;
                }) ;

            j = j +1;
            }

        map.fitBounds(bounds) ;

        if( j == 1 )
            {  
            var listener = google.maps.event.addListener(map, "idle", function() { 
                map.setZoom(12) ; 
                google.maps.event.removeListener(listener) ; 
                }) ;    
            }
        }

    function addLoadEvent(func) 
        {
        var oldonload = window.onload ;
        if( typeof window.onload != 'function' )
            {
            window.onload = func ;
            } 
        else 
            {
            window.onload = function() 
                {
                if( oldonload ) 
                    {
                    oldonload() ;
                    }
                func() ;
                }
            }
        }

</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTzBrrIIw3a_cNjObrMBSFyRUphI5xmYc&callback=initMap" type="text/javascript"></script>