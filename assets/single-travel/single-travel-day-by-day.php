<style>

    .box-left
        {
        padding-top: 5rem !important ; 
        padding-left: 13rem ;  
        padding-bottom: 5rem !important ;
        }

    .box-right
        {
        padding-top: 7rem !important ; 
        padding-right: 13rem ; 
        padding-bottom: 7rem !important ;
        }

    @media screen and (max-width: 992px) 
        {
        .box-left
            {
            padding-top: 3rem !important ; 
            padding-left: 8rem ; 
            padding-bottom: 3rem !important ;
            }

        .box-right
            {
            padding-top: 4rem !important ; 
            padding-right: 8rem ; 
            padding-bottom: 3rem important ;
            }
        }

    @media screen and (max-width: 600px) 
        {
        .box-left
            {
            padding-top: 1rem !important ; 
            padding-left: 5rem ; 
            padding-bottom: 1rem !important ;
            }

        .box-right
            {
            padding-top: 1.5rem !important ; 
            padding-right: 5rem ; 
            padding-bottom: 1rem !important ;
            }
        }

</style>

<?php

    date_default_timezone_set('UTC') ;
    setlocale(LC_ALL, 'it_IT.UTF-8') ;

    define('DRIVER', 'mysql');
    define('DB_HOST', 'kel12image.com');
    define('DB_NAME', 'kelimage_application');
    define('DB_USER', 'kelimage_mare_consulting');
    define('DB_PASSWORD', 'MareConsulting71!');
    define('DB_ENCODING', 'utf8');
    define('DB_PORT', '3306');

    try
        {
        $conn = new PDO("mysql:host=" .  constant('DB_HOST') . ";dbname=" . constant('DB_NAME') . ";user=" . constant('DB_USER') . ";password=" . constant('DB_PASSWORD') . ";options='--client_encoding=" . constant('DB_ENCODING') . "'") ;
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
        }
    catch(PDOException $e) 
        {
        echo "CONNESSIONE FALLITA: " . $e->getMessage() ;
        }

    $images = mc_get_img_daybyday_viaggio ("LEVI", $_GET['id'], $conn) ;

    $data = mc_apicall_daybyday( $_GET['id'] ) ;

?>

    <!-- DAY BY DAY START //-->

    <section id="day-by-day" style="margin-bottom:4% ;">
        <div class="container" style="margin-bottom:4% ;">
            <div class="row">
                <h2 class="title text-center m-auto"><i>Day</i> by <i>Day</i></h2> 
            </div>
        </div>
        <div class="container-fluid">
            <div class="row" style="padding-right:10% ; padding-left:10%">

                <?php 

                    $limit = 600 ;
                    $k == 1 ;

                    foreach($data["response"] as $day) 
                        { 
                        $img_array = array_filter($images, function($elem) use($k)
                            {
                            return $elem['id_giorno_daybyday'] == $k-1 ;
                            }) ;

                        $img_array_resorted = array_values($img_array) ;

                        if( ($k % 2) == 0 )
                            {
                            $background_color = "#F0E9D5" ;
                            }
                        else
                            {
                            $background_color = "#ffffff" ;  
                            }  

                        $template = count($img_array_resorted) ;
               

                        $content = trim( strip_tags( $day["descrizioneEstesa"] ) ) ;

                    
                        switch($template) 
                            {
                            case 0:

                                echo '<div class="col-12 col-sm-12 col-md-6 py-4 box-left" style="background-color:' . $background_color . '; ">' ;
                                    echo '<h5 class="payoff" style="color:#a06b1b ;">Giorno ' . $day["giorno"] . '</h5>' ;
                                    echo '<h2 class="title text-start" style="font-size:1.6rem ; max-width:500px;">' . $day["descrizioneBreve"] . '</h2>' ;
                                echo "</div>" ;
                                echo '<div class="col-12 col-sm-12 col-md-6 py-4 box-right" style="background-color: ' . $background_color . '; ">' ;

                                    if(strlen($content) >= $limit) 
                                        {
                                        $content_s = wordwrap($content, $limit);
                                        $content_s = substr($content_s, 0, strpos($content_s, "\n"));

                                        echo '<input type="hidden" class="dbd-content-short" name="dbd-content-short-' . $k . '" id="dbd-content-short-' . $k . '" value="' . strip_tags($content_s) . '" />' ;
                                        echo '<input type="hidden" class="dbd-content-long" name="dbd-content-long-' . $k . '" id="dbd-content-long-' . $k . '" value="' . strip_tags($content) . '" />' ;
                                        echo "<p class='content px-5 zzz' >" . trim( strip_tags( $content_s ) ) . "</p>" ;
                                        echo '<i class="fas fa-angle-double-down dbd-down" style="margin: auto; text-align: center; width: 100%; padding-top: 20px;cursor: pointer;"></i>' ;
                                        echo '<i class="fas fa-angle-double-up dbd-up" style="margin: auto; text-align: center; width: 100%; padding-top: 20px;cursor: pointer; display: none;"></i>' ;
                                        }
                                    else
                                        {
                                        echo "<p class='content px-5 zzz'>" . trim( strip_tags( $content ) ) . "</p>" ;
                                        }

                                echo "</div>" ;
                                break;
                            case 1:

                                echo '<div class="col-12 col-sm-12 col-md-6 py-4 box-left" style="background-color:' . $background_color . '">' ;
                                    echo '<h5 class="payoff" style="color:#a06b1b ;">Giorno ' . $day["giorno"] . '</h5>' ;
                                    echo '<h2 class="title text-start" style="font-size:1.6rem ; max-width:500px;">' . $day["descrizioneBreve"] . '</h2>' ;
                                echo "</div>" ;

                                echo '<div class="col-12 col-sm-12 col-md-6 py-4 box-right" style="background-color:' . $background_color . '; ">' ;

                                   
                                if(strlen($content) >= $limit) 
                                    {
                                    $content_s = wordwrap($content, $limit);
                                    $content_s = substr($content_s, 0, strpos($content_s, "\n"));

                                    echo "<input type='hidden' class='dbd-content-short' name='dbd-content-short-" . $k . "' id='dbd-content-short-" . $k . "' value='" . strip_tags($content_s) . "' />" ;
                                    echo "<input type='hidden' class='dbd-content-long' name='dbd-content-long-" . $k . "' id='dbd-content-long-" . $k . "' value='" . strip_tags($content) . "' />" ;
                                    echo '<p class="content px-5 zzz" >' . strip_tags( $content_s ) . '</p>' ;
                                    echo '<i class="fas fa-angle-double-down dbd-down" style="margin: auto; text-align: center; width: 100%; padding-top: 20px;cursor: pointer;"></i>' ;
                                    echo '<i class="fas fa-angle-double-up dbd-up" style="margin: auto; text-align: center; width: 100%; padding-top: 20px;cursor: pointer; display: none;"></i>' ;
                                    }
                                else
                                    {
                                    echo '<p class="content px-5 zzz">' . strip_tags( $content ) . '</p>' ;
                                    }

                                echo "</div>" ;
                                echo '<div class="col-12 col-sm-12 py-4 img-wrapper" style="background-color:' . $background_color . ';">' ;
                                    echo "<div style='text-align: center ; margin:auto ; max-width:600px;'>" ;
                                        echo '<img style="transform: rotate(2deg) translateY(-50px); z-index:1000000000000 ;" src="' . $img_array_resorted[0]["url_foto"] . '" class="img-fluid" />' ;
                                    echo "</div>" ;
                                echo "</div>" ;
                                break;
                            case 2:

                                echo '<div class="col-12 col-sm-12 col-md-6 py-4 box-left" style="background-color:' . $background_color . '">' ;
                                    echo '<h5 class="payoff" style="color:#a06b1b ;">Giorno ' . $day["giorno"] . '</h5>' ;
                                    echo '<h2 class="title text-start" style="font-size:1.6rem ; max-width:500px;">' . $day["descrizioneBreve"] . '</h2>' ;
                                echo "</div>" ;
                                echo '<div class="col-12 col-sm-12 col-md-6 py-4 box-right" style="background-color:' . $background_color . '">' ;

                                if(strlen($content) >= $limit) 
                                    {
                                    $content_s = wordwrap($content, $limit);
                                    $content_s = substr($content_s, 0, strpos($content_s, "\n"));

                                    echo "<input type='hidden' class='dbd-content-short' name='dbd-content-short-" . $k . "' id='dbd-content-short-" . $k . "' value='" . strip_tags($content_s) . "' />" ;
                                    echo "<input type='hidden' class='dbd-content-long' name='dbd-content-long-" . $k . "' id='dbd-content-long-" . $k . "' value='" . strip_tags($content) . "' />" ;
                                    echo '<p class="content px-5 zzz" >' . strip_tags( $content_s ) . '</p>' ;
                                    echo '<i class="fas fa-angle-double-down dbd-down" style="margin: auto; text-align: center; width: 100%; padding-top: 20px;cursor: pointer;"></i>' ;
                                    echo '<i class="fas fa-angle-double-up dbd-up" style="margin: auto; text-align: center; width: 100%; padding-top: 20px;cursor: pointer; display: none;"></i>' ;
                                    }
                                else
                                    {
                                    echo '<p class="content px-5 zzz">' . strip_tags( $content ) . '</p>' ;
                                    }

                                echo "</div>" ;
                                echo '<div class="col-12 col-sm-12 py-4 img-wrapper" style="padding:0 !important; margin:auto; text-align: center; background-color:' . $background_color . '">' ;
                                    echo '<div style="height:800px; width:100%; background-repeat: no-repeat; background-position: center center; background-size: cover; background-image:url(' . $img_array_resorted[0]["url_foto"] . ')" class="special" /></div>' ;
                                    echo '<img src="' . $img_array_resorted[1]["url_foto"] . '" class="img-fluid" style="max-width:600px; transform: translateY(-120px);"/>' ;
                                echo "</div>" ;
                                break;
                            case 3:

                                echo '<div class="col-12 col-sm-12 col-md-6 py-4 box-left" style="background-color:' . $background_color . '">' ;
                                    echo '<h5 class="payoff" style="color:#a06b1b ;">Giorno ' . $day["giorno"] . '</h5>' ;
                                    echo '<h2 class="title text-start" style="font-size:1.6rem ; max-width:500px;">' . $day["descrizioneBreve"] . '</h2>' ;
                                echo "</div>" ;
                                echo '<div class="col-12 col-sm-12 col-md-6 py-4 box-right" style="background-color:' . $background_color . '">' ;

                                if(strlen($content) >= $limit) 
                                    {
                                    $content_s = wordwrap($content, $limit);
                                    $content_s = substr($content_s, 0, strpos($content_s, "\n"));

                                    echo "<input type='hidden' class='dbd-content-short' name='dbd-content-short-" . $k . "' id='dbd-content-short-" . $k . "' value='" . strip_tags($content_s) . "' />" ;
                                    echo "<input type='hidden' class='dbd-content-long' name='dbd-content-long-" . $k . "' id='dbd-content-long-" . $k . "' value='" . strip_tags($content) . "' />" ;
                                    echo '<p class="content px-5 zzz" >' . strip_tags( $content_s ) . '</p>' ;
                                    echo '<i class="fas fa-angle-double-down dbd-down" style="margin: auto; text-align: center; width: 100%; padding-top: 20px;cursor: pointer;"></i>' ;
                                    echo '<i class="fas fa-angle-double-up dbd-up" style="margin: auto; text-align: center; width: 100%; padding-top: 20px;cursor: pointer; display: none;"></i>' ;
                                    }
                                else
                                    {
                                    echo '<p class="content px-5 zzz">' . strip_tags( $content ) . '</p>' ;
                                    }

                                echo "</div>" ;
                                echo '<div class="col-12 col-sm-12 py-4 img-wrapper" style="padding:0 !important; margin:auto; text-align: center; background-color:' . $background_color . '">' ;
                                    echo '<div style="height:800px; width:100%; background-repeat: no-repeat; background-position: center center; background-size: cover; background-image:url(' . $img_array_resorted[0]["url_foto"] . ')" class="special" /></div>' ;
                                    echo '<img src="' . $img_array_resorted[1]["url_foto"] . '" class="img-fluid" style="max-width:600px; transform:rotate(-5deg) translateX(30px) translateY(-80px);" />' ;
                                    echo '<img src="' . $img_array_resorted[2]["url_foto"] . '" class="img-fluid" style="max-width:600px ; transform:rotate(5deg) translateX(-30px) translateY(-80px);" />' ;
                                echo "</div>" ;
                                break;
                            default:

                                echo '<div class="col-12 col-sm-12 col-md-6 py-4 box-left" style="background-color:' . $background_color . '">' ;
                                    echo '<h5 class="payoff" style="color:#a06b1b ;">Giorno ' . $day["giorno"] . '</h5>' ;
                                    echo '<h2 class="title text-start" style="font-size:1.6rem ; max-width:500px;">' . $day["descrizioneBreve"] . '</h2>' ;
                                echo "</div>" ;
                                echo '<div class="col-12 col-sm-12 py-4 box-right" style="background-color:' . $background_color . '">' ;

                                if(strlen($content) >= $limit) 
                                    {
                                    $content_s = wordwrap($content, $limit);
                                    $content_s = substr($content_s, 0, strpos($content_s, "\n"));

                                    echo "<input type='hidden' class='dbd-content-short' name='dbd-content-short-" . $k . "' id='dbd-content-short-" . $k . "' value='" . strip_tags($content_s) . "' />" ;
                                    echo "<input type='hidden' class='dbd-content-long' name='dbd-content-long-" . $k . "' id='dbd-content-long-" . $k . "' value='" . strip_tags($content) . "' />" ;
                                    echo '<p class="content px-5 zzz" >' . strip_tags( $content_s ) . '</p>' ;
                                    echo '<i class="fas fa-angle-double-down dbd-down" style="margin: auto; text-align: center; width: 100%; padding-top: 20px;cursor: pointer;"></i>' ;
                                    echo '<i class="fas fa-angle-double-up dbd-up" style="margin: auto; text-align: center; width: 100%; padding-top: 20px;cursor: pointer; display: none;"></i>' ;
                                    }
                                else
                                    {
                                    echo '<p class="content px-5 zzz">' . strip_tags( $content ) . '</p>' ;
                                    }

                                echo "</div>" ;
                            }

                        $k++ ;
                        } 

                ?>

            </div>   
        </div>
    </section>
    <!-- DAY BY DAY END //-->
