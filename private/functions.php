<?php

    require_once ( dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php' ) ;

    use PHPMailer\PHPMailer\PHPMailer ;
    use PHPMailer\PHPMailer\SMTP ;
    use PHPMailer\PHPMailer\Exception ;

    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;

    require ( dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "PHPMailer" . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "Exception.php" ) ;
    require ( dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "PHPMailer" . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "PHPMailer.php" ) ;
    require ( dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "PHPMailer" . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . "SMTP.php" ) ;


    if(!function_exists('log_manager')) 
        {
        function log_manager($filename, $lvl, $error)
            {
            /**
            * It logs the error to a file.
            * 
            * @param filename The name of the log file.
            * @param lvl The level of the log entry.
            * @param error The error message to log.
            */

            /**
            * Monolog supports the logging levels described by RFC 5424:
            * DEBUG (100): Detailed debug information.
            * INFO (200): Interesting events. Examples: User logs in, SQL logs.
            * NOTICE (250): Normal but significant events.
            * WARNING (300): Exceptional occurrences that are not errors. Examples: Use of deprecated APIs, poor use of an API, undesirable things that are not necessarily wrong.
            * ERROR (400): Runtime errors that do not require immediate action but should typically be logged and monitored.
            * CRITICAL (500): Critical conditions. Example: Application component unavailable, unexpected exception.
            * ALERT (550): Action must be taken immediately. Example: Entire website down, database unavailable, etc. This should trigger the SMS alerts and wake you up.
            * EMERGENCY (600): Emergency: system is unusable.	
            */  

            $log = new Logger( "SYSTEM" ) ;	
            $filename = constant("LOG_DIR") . DIRECTORY_SEPARATOR . $filename ;
            $msg = getcwd() . DIRECTORY_SEPARATOR . basename($_SERVER['SCRIPT_FILENAME']) . " | " . $_SERVER['REMOTE_ADDR'] . " | " . $_SERVER['HTTP_USER_AGENT'] . " | " . $error ;
            
            switch ($lvl) 
                {
                case "INFO":
                    $log->pushHandler(new StreamHandler($filename, Logger::INFO)) ;
                    $log->info($msg) ;
                    break ;
                case "NOTICE":
                    $log->pushHandler(new StreamHandler($filename, Logger::NOTICE)) ;
                    $log->notice($msg) ;
                    break ;
                case "WARNING":
                    $log->pushHandler(new StreamHandler($filename, Logger::WARNING)) ;
                    $log->warning($msg) ;
                    break ;
                case "ERROR":
                    $log->pushHandler(new StreamHandler($filename, Logger::ERROR)) ;
                    $log->error($msg) ;
                    break ;
                case "CRITICAL":
                    $log->pushHandler(new StreamHandler($filename, Logger::CRITICAL)) ;
                    $log->critical($msg) ;
                    break ;
                case "ALERT":
                    $log->pushHandler(new StreamHandler($filename, Logger::ALERT)) ;
                    $log->alert($msg) ;
                    break ;
                case "EMERGENCY":
                    $log->pushHandler(new StreamHandler($filename, Logger::EMERGENCY)) ;
                    $log->emergency($msg) ;
                    break ;
                default:
                    $log->pushHandler(new StreamHandler($filename, Logger::DEBUG)) ;
                    $log->debug($msg) ;
                }
            }
        }


    if(!function_exists('get_assets')) 
		{
		/**
        * It includes a file from the assets folder, and if a page is specified, it includes a file from the
        * assets folder with the page name in the file name
        * 
        * @param asset The asset you want to include.
        * @param page The page name.
        * @param title The title of the page.
        * @param conn This is the database connection.
        * @return the include_once() function.
        */

        function get_assets($asset, $title = "", $page = FALSE, $conn = NULL)
			{
            ($page) ? include_once( dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . $page . "-" . $asset . ".php") : include_once( dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . $asset . ".php") ;
		    }
        }


    if(!function_exists('calc_footer_columns')) 
        {
        /**
        * It counts the number of elements in the array and returns the count.
        * 
        * @param data The array of data to be displayed in the table.
        * @return The number of columns in the footer.
        */

        function calc_footer_columns($data)
            {
            $columns = 0 ;

            foreach($data as $e)
                {
                if( !empty($e) )
                    {
                    $columns++ ;
                    }
                }   
            return 12/$columns ;
            }
        }


    if(!function_exists('read_json_data')) 
        {
        function read_json_data($filename)
            {
            /**
            * It reads a json file and returns an array.
            * 
            * @param filename the name of the file to read
            * @return An array of data.
            */

            $filename = constant("JSON_DIR") . DIRECTORY_SEPARATOR . $filename . ".json" ;
            $data = file_get_contents($filename) ;

            if($data)
                {
                $result = json_decode($data, true) ;
                }
            else
                {
                $msg = "File " . $filename . " non trovato" ;
                log_manager("errors.log", "ALERT", $msg) ;
                $result = array() ;   
                } 
                
            return $result ;
            }
        }


    if(!function_exists('base_url')) 
        {
        function base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE)
            {
            /**
            * It returns the base URL of the website.
            * 
            * @param atRoot TRUE if you want your base URL to be the root of your domain, FALSE if you
            * want it to be the root of your application.
            * @param atCore TRUE/FALSE (boolean) - whether to return the core folder/hostname.
            * @param parse If TRUE, will return an array of the URL parts. If FALSE, will return the URL
            * string.
            * @return The base url of the site.
            */

            if (isset($_SERVER['HTTP_HOST']))
                {
                $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http' ;
                $hostname = $_SERVER['HTTP_HOST'] ;
                $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']) ;

                $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY) ;
                $core = $core[0] ;

                $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s") ;
                $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir) ;
                $base_url = sprintf( $tmplt, $http, $hostname, $end ) ;
                }
            else $base_url = 'http://localhost/' ;

            if ($parse) 
                {
                $base_url = parse_url($base_url) ;
                if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '' ;
                }

            return $base_url ;
            }
        } 


    if(!function_exists('mc_middleware_call')) 	
		{		
        function mc_middleware_call($url, $endpoint, $params = NULL)
			{
            /* A function that calls a middleware and returns the data. */

            $curl = curl_init() ;
				
            curl_setopt($curl, CURLOPT_URL, $url  . DIRECTORY_SEPARATOR . $params  . DIRECTORY_SEPARATOR . $endpoint) ;
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);   
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1) ;
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1) ;
            curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1) ;

            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type:application/json',
                'Cache-Control: no-cache',
                'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0'
                )
            ) ;
		
            try
                {
                $response = curl_exec($curl) ;
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE) ;
                }
            catch(Exception $e) 
                {
                log_manager("errors.log", "ALERT", $e->getMessage()) ;
                }
           
			curl_close($curl) ;

			return ( $httpcode == "200" ) ? json_decode($response, true) : read_json_data($endpoint) ;
			}  
		}
        
        
    if(!function_exists('create_api_token')) 	
		{
		/**
		 * It creates a token for the API.
		 * 
		 * @return The encrypted string.
		 */
		function create_api_token()
			{
			$textToEncrypt = strftime(constant("TEXT_TO_ENCRYPT")) ;
			$encryptionMethod = "AES-256-CBC" ;
			$secretHash = constant("SECRET_HASH") ;

			return openssl_encrypt($textToEncrypt, $encryptionMethod, $secretHash) ;
			}
		}


    if(!function_exists('mc_get_img_areageo')) 	
		{	
		function mc_get_img_areageo ($website, $id_areageografica, $type, $conn)
			{
			$sql="SELECT * FROM mc_tassonomie WHERE nome = '$type' ";

			foreach ($conn->query($sql) as $row) {
				$id_tassonomia_areageo  = $row['id'];
			}

			$sql="SELECT * FROM `mc_foto_areageografica` as AG JOIN mc_foto_tassonomie_website AS WS ON AG.id_foto = WS.id_foto join mc_tassonomie as TAS ON TAS.id = WS.id_tassonomia JOIN foto as FT on FT.id_foto = WS.id_foto WHERE (AG.id_areageografica = $id_areageografica and TAS.nome = '$type');";
			  
            foreach ($conn->query($sql) as $row_foto) {
				$id_foto  = $row_foto['id_foto']; 
			}
		
			if($id_foto and $id_tassonomia_areageo )
			    {
                $src = constant("KEL12_IMAGE_BASE_URL") . "/" . $row_foto['continente'] . "/" . $row_foto['nome'] . ".jpg" ;

				$a = array(
					"id_foto"       => $row_foto['id_foto'],
					"nome"          => $row_foto['nome'], 
					"titolo"        => $row_foto['titolo'] , 
					"descrizione"   => $row_foto['descrizione'],  
					"width"         => $row_foto['width'], 
					"height"        => $row_foto['height'], 
					"url_foto"      => $src
				);

			    return $a ;
			    } 
			}
		}


    if(!function_exists('mc_get_img_business_object'))
        {
        function mc_get_img_business_object($website, $idlineaviaggio, $type, $typeBO, $conn)
		    {
            // cerco immagine con id business objetc - linee viaggio - Tout Leader  con tipoBO (LINEAVIAGGIO / TOUR LEADER) -- se esiste
            // cerco per nome la id della tassonomia sito web
            // cerco per nome la id della tassonomia di interesse $type = CARD-LINEEVIAGGIO o BANNER-LINEEVIAGGIO / TOURLEADER 
            
            $sql="SELECT * FROM mc_foto_business_object AS BO JOIN foto AS FT ON BO.id_foto = FT.id_foto where (id_business_object = '$idlineaviaggio' AND type_business_object = '$typeBO')";
            
            foreach ($conn->query($sql) as $row_foto) 
                {
                $id_foto  = $row_foto['id_foto']; 
                }

            $id_tassonomia_lineaviaggio = 0;
            
            $sql="SELECT * FROM mc_tassonomie WHERE nome = '$type' ";

            foreach ($conn->query($sql) as $row) 
                {
                $id_tassonomia_lineaviaggio  = $row['id'];
                }
       
            $sql="SELECT * FROM mc_tassonomie WHERE nome = '$website'";

            foreach ($conn->query($sql) as $row) 
                {
                $id_tassonomia_website  = $row['id'];
                }

            if($id_foto and $id_tassonomia_website and $id_tassonomia_lineaviaggio  )
                {
                $ok_lineaviaggio = 0;
                $ok_website = 0;
            
                $sql="SELECT * FROM `mc_foto_tassonomie_website` where id_foto = $id_foto and (id_tassonomia =  $id_tassonomia_website )";
                
                foreach ($conn->query($sql) as $row) 
                    {
                    $ok_website = 1;
                    }

                if(!$ok_website)
                    {
                    $errore .= " immagine $id_foto non associata a: $website -";
                    throw new Exception("$errore");
                    }
            
                $sql="SELECT * FROM `mc_foto_tassonomie_website` where id_foto = $id_foto and (id_tassonomia =  $id_tassonomia_lineaviaggio  )";

                foreach ($conn->query($sql) as $row) 
                    {
                    $ok_lineaviaggio = 1;
                    }

                if(!$ok_lineaviaggio )
                    {
                    $errore .= "immagine $id_foto non associata a: $type -";
                    throw new Exception("$errore");
                    }
                
                if($ok_lineaviaggio and $ok_website  )
                    {
                    $src = constant("KEL12_IMAGE_BASE_URL") . "/" . $row_foto['continente'] . "/" . $row_foto['nome'] . ".jpg" ;
                    $a = array(
                        "id_foto"       => $row_foto['id_foto'],
                        "nome"          => $row_foto['nome'], 
                        "titolo"        => $row_foto['titolo'] , 
                        "descrizione"   => $row_foto['descrizione'],  
                        "width"         => $row_foto['width'], 
                        "height"        => $row_foto['height'], 
                        "url_foto"      => $src
                    );
                    return $a ;
                    }	
                }
            else 
                {
                throw new Exception("$errore");
                }		  
            }
        }


    if(!function_exists('mc_get_img_banner_viaggi')) 	
		{	
		/**
		 * It returns an array of data about the banner image for a given trip.
		 * 
		 * @param website the website name, e.g. "levi"
		 * @param idviaggio the id of the trip
		 * @param type the type of image you want to get.
		 * @param conn the database connection
		 * @param kel12_image_base_url the base url for the images.
		 * 
		 * @return An array of the image data.
		 */
		function mc_get_img_banner_viaggi($website, $idviaggio, $type, $conn, $kel12_image_base_url)
			{
			$src = "/img/levi-logo.svg" ;  

			$sql = "SELECT id
					FROM mc_tassonomie
					WHERE nome = ?
					OR nome = ?
					ORDER BY nome" ;

			$rs = $conn->prepare($sql) ;
			$rs->bindParam(1, $type, PDO::PARAM_STR) ;
			$rs->bindParam(2, $website, PDO::PARAM_STR) ;
	
			$rs->execute() ;

			$result = $rs->fetchAll(PDO::FETCH_ASSOC) ;

			$sql = 	"SELECT A.*, B.*, C.*
					FROM 	foto AS A, mc_foto_tassonomie AS B, mc_foto_tassonomie_website AS C
					WHERE  	A.id_foto = B.id_foto
					AND 	A.id_foto = C.id_foto
					AND 	B.id_viaggio_kel12 = ?
					AND 	B.id_tassonomia = ?
					AND 	C.id_tassonomia = ?" ;

			$rs = $conn->prepare($sql) ;
			
			$rs->bindParam(1, $idviaggio, PDO::PARAM_INT) ;
			$rs->bindParam(2, $result[0]['id'], PDO::PARAM_INT) ;
			$rs->bindParam(3, $result[1]['id'], PDO::PARAM_INT) ;

			$rs->execute() ;

			$result = $rs->fetch(PDO::FETCH_ASSOC) ;

			if($result)
				{
				$src = $kel12_image_base_url . "/" . $result['continente'] . "/" .$result['nome'] . ".jpg" ;
				}

			$img_array = array(
				"id_foto"       => $result['id_foto'],
				"nome"          => $result['nome'], 
				"titolo"        => $result['titolo'] , 
				"descrizione"   => $result['descrizione'],  
				"width"         => $result['width'], 
				"height"        => $result['height'], 
				"url_foto"      => $src
				);

			return $img_array ;
			}
		}


    if(!function_exists('mc_get_img_nazione')) 	
		{	
        function mc_get_img_nazione($website, $id_nazione, $type, $conn)
            {
            $base_url =  "https://kel12image.com/" ;
            $src = "/img/levi-logo.svg" ;  

            $sql = "SELECT * 
                    FROM mc_tassonomie 
                    WHERE nome = '" . $type . "' ;" ;

            foreach($conn->query($sql) as $row) 
                {
                $id_tassonomia_areageo  = $row['id'];
                }
            
            $sql = "SELECT * 
                    FROM mc_foto_nazione as AG 
                    JOIN mc_foto_tassonomie_website AS WS 
                    ON AG.id_foto = WS.id_foto 
                    join mc_tassonomie as TAS 
                    ON TAS.id = WS.id_tassonomia 
                    JOIN foto as FT on FT.id_foto = WS.id_foto 
                    WHERE (AG.id_nazione = " . $id_nazione . " and TAS.nome = '" . $type . "');" ;


            foreach($conn->query($sql) as $row_foto) 
                {
                $id_foto  = $row_foto['id_foto']; 
                }

            if($id_foto && $id_tassonomia_areageo)
                {
                $src = $base_url . "uploads/" .$row_foto['continente'] ."/" .$row_foto['nome'] .".jpg";
                }

            $a = array(
                "id_foto"       => $row_foto['id_foto'],
                "nome"          => $row_foto['nome'], 
                "titolo"        => $row_foto['titolo'] , 
                "descrizione"   => $row_foto['descrizione'],  
                "width"         => $row_foto['width'], 
                "height"        => $row_foto['height'], 
                "url_foto"      => $src
                ) ;

            return $a ;
            } 
        }


    if(!function_exists('mc_get_img_daybyday_viaggio')) 	
		{	
        function mc_get_img_daybyday_viaggio ($website, $idviaggio, $conn)
            {
            //assumiamo che la gallery sia uguale per tutti i siti
            //website lo passo per eventuali modifiche future
            $base_url =  "https://kel12image.com/" ;
            $errore = "ATT.NE: ";
            $id_foto = array();
            
            $ii = 0;
            
            $id_tassonomia_website = 0;
            $sql="SELECT * FROM mc_tassonomie WHERE nome = '$website'";
            foreach ($conn->query($sql) as $row) {
                $id_tassonomia_website  = $row['id'];
            }
            if(!$id_tassonomia_website)
            {
                $errore .= " non trovata tassonomia: $website -";
                throw new Exception("$errore");
            }
            
            $sql="SELECT * FROM mc_foto_daybyday AS DBD JOIN foto AS FT ON FT.id_foto = DBD.id_foto JOIN mc_foto_tassonomie_website AS WS ON WS.id_foto = DBD.id_foto WHERE DBD.id_viaggio_kel12 = $idviaggio AND WS.id_tassonomia = $id_tassonomia_website";
            foreach ($conn->query($sql) as $row_foto) {
                $src = $base_url . "uploads/" .$row_foto['continente'] ."/" .$row_foto['nome'] .".jpg";

                $a[$ii]['id_giorno_daybyday'] = $row_foto['id_giorno_daybyday']; 
                $a[$ii]['id_foto'] = $row_foto['id_foto']; 
                $a[$ii]['nome'] = $row_foto['nome'];  
                $a[$ii]['titolo'] =  $row_foto['titolo'] ;  
                $a[$ii]['descrizione']   = $row_foto['descrizione']; 
                $a[$ii]['width']  =  $row_foto['width']; 
                $a[$ii]['height'] =  $row_foto['height'];
                $a[$ii]['url_foto']  = $src;
                
                $ii = $ii + 1;
                

            }
            if(!$ii)
            {
                $errore .= " Non ci sono viaggi pubblicati per il viaggio: $idviaggio  per il sito $website  - ";
                //throw new Exception("$errore");
            } 
            return $a ;
        }
    }


    if(!function_exists('mc_get_img_gallery')) 	
		{	
        function mc_get_img_gallery ($website, $idviaggio, $type, $conn)
		{
			//assumiamo che la gallery sia uguale per tutti i siti
			//website lo passo per eventuali modifiche future
			$base_url =  "https://kel12image.com/" ;
			$errore = "ATT.NE: ";
			$id_foto = array();
			$sql="SELECT * FROM icnc_foto_viaggi AS FV JOIN foto AS FT ON FV.ID_foto = FT.id_foto where (IdViaggioKel = '$idviaggio' AND (type = '$type' or type = ''))";
			$ii = 0;
			
		
			foreach ($conn->query($sql) as $row_foto) {
				$src = $base_url . "uploads/" .$row_foto['continente'] ."/" .$row_foto['nome'] .".jpg";
				$a[$ii]['id_foto'] = $row_foto['ID_foto_viaggi']; 
				$a[$ii]['nome'] = $row_foto['nome'];  
				$a[$ii]['titolo'] =  $row_foto['titolo'] ;  
				$a[$ii]['descrizione']   = $row_foto['descrizione']; 
				$a[$ii]['width']  =  $row_foto['width']; 
				$a[$ii]['height'] =  $row_foto['height'];
				$a[$ii]['url_foto']  = $src;
				
				$ii = $ii + 1;
				
		
			}
			if(!$ii)
			{
				$errore .= " NO GALLERY - ";
				throw new Exception("$errore");
			} 
			return $a ;
		}
    }
		
?>